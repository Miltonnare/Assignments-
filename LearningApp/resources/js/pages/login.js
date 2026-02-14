import { renderLayout } from '../layout.js';
import { auth } from '../auth.js';
import { navigate } from '../router.js';

export function render(root) {
    if (auth.isAuthenticated) {
        navigate('/dashboard');
        return;
    }

    const content = `
        <div class="max-w-md mx-auto">
            <h1 class="text-2xl font-semibold mb-6">Log in</h1>
            <form id="login-form" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div id="login-error" class="text-red-600 dark:text-red-400 text-sm hidden"></div>
                <button type="submit" id="login-submit" class="w-full py-2.5 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Log in
                </button>
            </form>
            <p class="mt-4 text-center text-zinc-600 dark:text-zinc-400 text-sm">
                Don't have an account? <a href="#/register" class="text-emerald-600 dark:text-emerald-400 hover:underline">Sign up</a>
            </p>
        </div>
    `;
    renderLayout(root, { content });

    const form = root.querySelector('#login-form');
    const errEl = root.querySelector('#login-error');
    const submitBtn = root.querySelector('#login-submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        errEl.classList.add('hidden');
        errEl.textContent = '';
        const email = form.email.value.trim();
        const password = form.password.value;
        submitBtn.disabled = true;
        try {
            await auth.login({ email, password });
            navigate('/dashboard');
        } catch (err) {
            const msg = err.response?.data?.message || err.response?.data?.errors?.email?.[0] || 'Login failed.';
            errEl.textContent = msg;
            errEl.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
        }
    });
}
