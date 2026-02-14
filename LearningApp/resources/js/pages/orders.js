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

export async function render(root) {
    if (!auth.isAuthenticated) {
        navigate('/login');
        return;
    }

    renderLayout(root, { content: '<div class="flex justify-center py-12"><span class="text-zinc-500">Loading…</span></div>' });

    try {
        const { data } = await api.get('/orders', { params: { per_page: 20 } });
        const orders = data.data || [];
        const meta = data.meta || {};

        const content = `
            <h1 class="text-2xl font-semibold mb-8">My orders</h1>
            <div class="space-y-4">
                ${orders.length === 0
                    ? '<p class="text-zinc-500 py-8">No orders yet.</p>'
                    : orders.map((o) => `
                        <a href="#/orders/${o.id}" class="block p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition">
                            <div class="flex flex-wrap justify-between items-start gap-2">
                                <div>
                                    <span class="font-medium">${o.service ? esc(o.service.title) : 'Order #' + o.id}</span>
                                    <span class="ml-2 text-zinc-500 text-sm">$${Number(o.amount).toFixed(2)}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-xs ${o.status === 'completed' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300' : o.status === 'cancelled' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400'}">${esc(o.status)}</span>
                            </div>
                            ${o.freelancer ? `<p class="text-sm text-zinc-500 mt-1">Freelancer: ${esc(o.freelancer.name)}</p>` : ''}
                        </a>
                    `).join('')}
            </div>
            ${meta.last_page > 1 ? `<p class="mt-4 text-sm text-zinc-500">Page ${meta.current_page} of ${meta.last_page}</p>` : ''}
        `;
        root.querySelector('main').innerHTML = content;
    } catch (e) {
        root.querySelector('main').innerHTML = `<div class="text-red-600 dark:text-red-400">Failed to load orders.</div>`;
    }
}
