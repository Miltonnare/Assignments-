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
    if (!auth.isAuthenticated || (!auth.isClient() && !auth.isAdmin())) {
        navigate('/');
        return;
    }
    const isNew = path === '/jobs/new' || path.endsWith('/new');
    const id = path.match(/\/jobs\/(\d+)\/edit/)?.[1] || null;

    let job = null;
    if (id) {
        try {
            const { data } = await api.get(`/jobs/${id}`);
            job = data;
            if (auth.user?.id !== job.client?.id && !auth.isAdmin()) {
                navigate('/jobs');
                return;
            }
        } catch {
            navigate('/jobs');
            return;
        }
    }

    const content = `
        <div class="max-w-lg">
            <h1 class="text-2xl font-semibold mb-6">${isNew ? 'Post a job' : 'Edit job'}</h1>
            <form id="job-form" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Title</label>
                    <input type="text" id="title" name="title" required value="${esc(job?.title)}"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Description</label>
                    <textarea id="description" name="description" required rows="4"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">${esc(job?.description)}</textarea>
                </div>
                <div>
                    <label for="budget" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Budget ($)</label>
                    <input type="number" id="budget" name="budget" required min="0" step="0.01" value="${job?.budget ?? ''}"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                </div>
                ${!isNew ? `
                <div>
                    <label for="status" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Status</label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                        <option value="open" ${job?.status === 'open' ? 'selected' : ''}>Open</option>
                        <option value="in_progress" ${job?.status === 'in_progress' ? 'selected' : ''}>In progress</option>
                        <option value="completed" ${job?.status === 'completed' ? 'selected' : ''}>Completed</option>
                    </select>
                </div>
                ` : ''}
                <div id="job-form-error" class="text-red-600 dark:text-red-400 text-sm hidden"></div>
                <div class="flex gap-3">
                    <button type="submit" id="job-submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">${isNew ? 'Post job' : 'Save'}</button>
                    <a href="#/jobs" class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-800">Cancel</a>
                </div>
            </form>
        </div>
    `;
    renderLayout(root, { content });

    const form = root.querySelector('#job-form');
    const errEl = root.querySelector('#job-form-error');
    const submitBtn = root.querySelector('#job-submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        errEl.classList.add('hidden');
        const payload = {
            title: form.title.value.trim(),
            description: form.description.value.trim(),
            budget: parseFloat(form.budget.value),
        };
        if (!isNew && form.status) payload.status = form.status.value;
        submitBtn.disabled = true;
        try {
            if (isNew) {
                await api.post('/jobs', payload);
                navigate('/jobs');
            } else {
                await api.put(`/jobs/${id}`, payload);
                navigate(`/jobs/${id}`);
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
