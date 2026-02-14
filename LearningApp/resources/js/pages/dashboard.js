import { renderLayout } from '../layout.js';
import { auth } from '../auth.js';
import { navigate } from '../router.js';

export function render(root) {
    if (!auth.isAuthenticated) {
        navigate('/login');
        return;
    }

    const user = auth.user;
    const role = user?.role || 'client';
    const links = [];
    links.push({ href: '#/services', label: 'Browse services' });
    links.push({ href: '#/jobs', label: 'Browse jobs' });
    links.push({ href: '#/orders', label: 'My orders' });
    if (auth.isFreelancer()) {
        links.push({ href: '#/services/new', label: 'Create a service' });
        links.push({ href: '#/profile', label: 'Edit my profile' });
    }
    if (auth.isClient()) {
        links.push({ href: '#/jobs/new', label: 'Post a job' });
    }

    const content = `
        <div>
            <h1 class="text-2xl font-semibold mb-2">Dashboard</h1>
            <p class="text-zinc-600 dark:text-zinc-400 mb-8">Welcome back, ${escapeHtml(user?.name || 'User')}. You're signed in as <strong>${escapeHtml(role)}</strong>.</p>
            <div class="grid gap-4 sm:grid-cols-2">
                ${links.map(({ href, label }) => `
                    <a href="${href}" class="block p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition">
                        <span class="font-medium">${escapeHtml(label)}</span>
                    </a>
                `).join('')}
            </div>
        </div>
    `;
    renderLayout(root, { content });
}

function escapeHtml(s) {
    if (s == null) return '';
    const div = document.createElement('div');
    div.textContent = s;
    return div.innerHTML;
}
