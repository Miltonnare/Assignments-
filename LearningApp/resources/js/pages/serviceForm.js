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
    if (!auth.isAuthenticated || !auth.isFreelancer()) {
        navigate('/');
        return;
    }
    const match = path.match(/\/services\/(new|(\d+)\/edit)/);
    const isNew = path.endsWith('/new') || path === '/services/new';
    const id = match ? (match[2] || null) : null;

    let service = null;
    if (id) {
        try {
            const { data } = await api.get(`/services/${id}`);
            service = data;
            if (auth.user?.id !== service.freelancer?.id) {
                navigate('/services');
                return;
            }
        } catch {
            navigate('/services');
            return;
        }
    }

    const content = `
        <div class="max-w-lg">
            <h1 class="text-2xl font-semibold mb-6">${isNew ? 'Create service' : 'Edit service'}</h1>
            <form id="service-form" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Title</label>
                    <input type="text" id="title" name="title" required value="${esc(service?.title)}"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Description</label>
                    <textarea id="description" name="description" required rows="4"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">${esc(service?.description)}</textarea>
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Price ($)</label>
                    <input type="number" id="price" name="price" required min="0" step="0.01" value="${service?.price ?? ''}"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label for="delivery_days" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Delivery (days)</label>
                    <input type="number" id="delivery_days" name="delivery_days" required min="1" value="${service?.delivery_days ?? ''}"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div id="service-form-error" class="text-red-600 dark:text-red-400 text-sm hidden"></div>
                <div class="flex gap-3">
                    <button type="submit" id="service-submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">${isNew ? 'Create' : 'Save'}</button>
                    <a href="#/services" class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-800">Cancel</a>
                </div>
            </form>
        </div>
    `;
    renderLayout(root, { content });

    const form = root.querySelector('#service-form');
    const errEl = root.querySelector('#service-form-error');
    const submitBtn = root.querySelector('#service-submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        errEl.classList.add('hidden');
        const payload = {
            title: form.title.value.trim(),
            description: form.description.value.trim(),
            price: parseFloat(form.price.value),
            delivery_days: parseInt(form.delivery_days.value, 10),
        };
        submitBtn.disabled = true;
        try {
            if (isNew) {
                await api.post('/services', payload);
                navigate('/services');
            } else {
                await api.put(`/services/${id}`, payload);
                navigate(`/services/${id}`);
            }
        } catch (err) {
            const data = err.response?.data;
            const msg = data?.message || (data?.errors && Object.values(data.errors).flat().join(' ')) || 'Failed to save.';
            errEl.textContent = msg;
            errEl.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
        }
    });
}
