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
        const { data } = await api.get('/jobs', { params: { per_page: 20 } });
        const jobs = data.data || [];
        const meta = data.meta || {};
        const createLink = auth.isClient() || auth.isAdmin() ? '<a href="#/jobs/new" class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">Post a job</a>' : '';

        const content = `
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <h1 class="text-2xl font-semibold">Jobs</h1>
                ${createLink}
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                ${jobs.length === 0
                    ? '<p class="col-span-full text-zinc-500 py-8">No jobs yet.</p>'
                    : jobs.map((j) => `
                        <a href="#/jobs/${j.id}" class="block p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition">
                            <h2 class="font-semibold text-lg mb-1">${esc(j.title)}</h2>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm line-clamp-2 mb-2">${esc(j.description)}</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-medium text-emerald-600 dark:text-emerald-400">$${Number(j.budget).toFixed(2)}</span>
                                <span class="px-2 py-0.5 rounded text-xs ${j.status === 'open' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400'}">${esc(j.status)}</span>
                            </div>
                        </a>
                    `).join('')}
            </div>
            ${meta.last_page > 1 ? `<p class="mt-4 text-sm text-zinc-500">Page ${meta.current_page} of ${meta.last_page}</p>` : ''}
        `;
        root.querySelector('main').innerHTML = content;
    } catch (e) {
        root.querySelector('main').innerHTML = `<div class="text-red-600 dark:text-red-400">Failed to load jobs.</div>`;
    }
}
