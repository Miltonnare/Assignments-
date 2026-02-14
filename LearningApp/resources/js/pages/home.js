import { renderLayout } from '../layout.js';
import { auth } from '../auth.js';

export function render(root) {
    const isAuth = auth.isAuthenticated;
    const hero = `
        <div class="text-center py-16 md:py-24">
            <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white mb-4">Find skills. Get work done.</h1>
            <p class="text-lg text-zinc-600 dark:text-zinc-400 max-w-xl mx-auto mb-8">Connect with freelancers or offer your services. Post jobs, buy services, and grow.</p>
            ${!isAuth ? `
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#/register" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-medium hover:bg-emerald-700">Get started</a>
                    <a href="#/login" class="px-6 py-3 rounded-xl border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800">Log in</a>
                </div>
            ` : `
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#/services" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-medium hover:bg-emerald-700">Browse services</a>
                    <a href="#/jobs" class="px-6 py-3 rounded-xl border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800">Browse jobs</a>
                    <a href="#/dashboard" class="px-6 py-3 rounded-xl border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800">Dashboard</a>
                </div>
            `}
        </div>
    `;
    renderLayout(root, { content: hero });
}
