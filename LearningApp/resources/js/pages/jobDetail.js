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
    const id = path.replace('/jobs/', '');
    if (!id) {
        navigate('/jobs');
        return;
    }

    renderLayout(root, { content: '<div class="flex justify-center py-12"><span class="text-zinc-500">Loading…</span></div>' });

    try {
        const { data: job } = await api.get(`/jobs/${id}`);
        const isOwner = auth.user?.id === job.client?.id;

        const content = `
            <div class="mb-6">
                <a href="#/jobs" class="text-emerald-600 dark:text-emerald-400 hover:underline text-sm">← Back to jobs</a>
            </div>
            <article class="max-w-2xl">
                <h1 class="text-2xl font-semibold mb-2">${esc(job.title)}</h1>
                <p class="text-zinc-600 dark:text-zinc-400 mb-4">${esc(job.description)}</p>
                <div class="flex flex-wrap gap-4 mb-6">
                    <span class="font-medium text-emerald-600 dark:text-emerald-400">Budget: $${Number(job.budget).toFixed(2)}</span>
                    <span class="px-2 py-0.5 rounded text-sm ${job.status === 'open' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300' : 'bg-zinc-100 dark:bg-zinc-800'}">${esc(job.status)}</span>
                    ${job.client ? `<span class="text-zinc-500">Posted by ${esc(job.client.name)}</span>` : ''}
                </div>
                ${isOwner ? `<a href="#/jobs/${job.id}/edit" class="inline-block px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-800">Edit</a>` : ''}
            </article>
        `;
        root.querySelector('main').innerHTML = content;
    } catch (e) {
        root.querySelector('main').innerHTML = `<div class="text-red-600 dark:text-red-400">Job not found.</div>`;
    }
}
