import { renderLayout } from '../layout.js';
import api from '../api.js';
import { auth } from '../auth.js';
import { navigate } from '../router.js';

function esc(s) {
    if (s == null) return '';
    const d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
}

export async function render(root, path) {
    if (!auth.isAuthenticated) {
        navigate('/login');
        return;
    }
    const id = path.replace('/services/', '');
    if (!id) {
        navigate('/services');
        return;
    }

    renderLayout(root, { content: '<div class="flex justify-center py-12"><span class="text-zinc-500">Loading…</span></div>' });

    try {
        const { data: service } = await api.get(`/services/${id}`);
        const isOwner = auth.user?.id === service.freelancer?.id;
        const isClient = auth.isClient() || auth.isAdmin();
        const canOrder = isClient && !isOwner;

        const content = `
            <div class="mb-6">
                <a href="#/services" class="text-emerald-600 dark:text-emerald-400 hover:underline text-sm">← Back to services</a>
            </div>
            <article class="max-w-2xl">
                <h1 class="text-2xl font-semibold mb-2">${esc(service.title)}</h1>
                <p class="text-zinc-600 dark:text-zinc-400 mb-4">${esc(service.description)}</p>
                <div class="flex flex-wrap gap-4 mb-6">
                    <span class="font-medium text-emerald-600 dark:text-emerald-400">$${Number(service.price).toFixed(2)}</span>
                    <span class="text-zinc-500">Delivery: ${esc(service.delivery_days)} days</span>
                    ${service.freelancer ? `<span class="text-zinc-500">By ${esc(service.freelancer.name)}</span>` : ''}
                </div>
                ${canOrder ? `<button type="button" id="order-service-btn" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">Order this service</button>` : ''}
                ${isOwner ? `<a href="#/services/${service.id}/edit" class="inline-block px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-800">Edit</a>` : ''}
            </article>
        `;
        root.querySelector('main').innerHTML = content;

        const orderBtn = root.querySelector('#order-service-btn');
        if (orderBtn) {
            orderBtn.addEventListener('click', async () => {
                orderBtn.disabled = true;
                try {
                    await api.post('/orders', { service_id: service.id });
                    navigate('/orders');
                } catch (err) {
                    const msg = err.response?.data?.message || err.response?.data?.errors?.service_id?.[0] || 'Could not create order.';
                    alert(msg);
                } finally {
                    orderBtn.disabled = false;
                }
            });
        }
    } catch (e) {
        root.querySelector('main').innerHTML = `<div class="text-red-600 dark:text-red-400">Service not found.</div>`;
    }
}
