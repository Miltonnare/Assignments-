import { auth } from './auth.js';
import { navigate } from './router.js';

function esc(s) {
    if (s == null) return '';
    const div = document.createElement('div');
    div.textContent = s;
    return div.innerHTML;
}

export function renderLayout(root, { title = 'Skill Marketplace', content = '' }) {
    const user = auth.user;
    const isAuth = auth.isAuthenticated;

    const navLinks = [];
    if (isAuth) {
        navLinks.push(`<a href="#/dashboard" class="px-3 py-2 rounded-lg text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-zinc-100">Dashboard</a>`);
        navLinks.push(`<a href="#/services" class="px-3 py-2 rounded-lg text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-800">Services</a>`);
        navLinks.push(`<a href="#/jobs" class="px-3 py-2 rounded-lg text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-800">Jobs</a>`);
        navLinks.push(`<a href="#/orders" class="px-3 py-2 rounded-lg text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-800">Orders</a>`);
        if (auth.isFreelancer()) {
            navLinks.push(`<a href="#/profile" class="px-3 py-2 rounded-lg text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-800">My Profile</a>`);
        }
    }

    const authSection = isAuth
        ? `<span class="text-zinc-500 dark:text-zinc-400 text-sm mr-2">${esc(user?.name)} (${esc(user?.role)})</span>
           <button type="button" id="logout-btn" class="px-4 py-2 rounded-lg bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-700">Logout</button>`
        : `<a href="#/login" class="px-4 py-2 rounded-lg text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-800">Log in</a>
           <a href="#/register" class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">Sign up</a>`;

    root.innerHTML = `
        <div class="min-h-screen flex flex-col">
            <header class="sticky top-0 z-10 border-b border-zinc-200 dark:border-zinc-800 bg-white/90 dark:bg-zinc-900/90 backdrop-blur">
                <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
                    <a href="#/" class="font-semibold text-lg text-zinc-900 dark:text-white">Skill Marketplace</a>
                    <nav class="flex items-center gap-1">
                        ${navLinks.join('')}
                        <div class="ml-4 flex items-center gap-2">
                            ${authSection}
                        </div>
                    </nav>
                </div>
            </header>
            <main class="flex-1 max-w-6xl w-full mx-auto px-4 py-8">
                ${content}
            </main>
        </div>
    `;

    const logoutBtn = root.querySelector('#logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            auth.logout();
            navigate('/');
        });
    }
}
