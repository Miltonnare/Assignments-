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
            <h1 class="text-2xl font-semibold mb-6">Create account</h1>
            <form id="register-form" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Password</label>
                    <input type="password" id="password" name="password" required minlength="8"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">I want to</label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="client">Hire freelancers (Client)</option>
                        <option value="freelancer">Offer services (Freelancer)</option>
                    </select>
                </div>
                <div id="register-error" class="text-red-600 dark:text-red-400 text-sm hidden"></div>
                <button type="submit" id="register-submit" class="w-full py-2.5 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Sign up
                </button>
            </form>
            <p class="mt-4 text-center text-zinc-600 dark:text-zinc-400 text-sm">
                Already have an account? <a href="#/login" class="text-emerald-600 dark:text-emerald-400 hover:underline">Log in</a>
            </p>
        </div>
    `;
    renderLayout(root, { content });

    const form = root.querySelector('#register-form');
    const errEl = root.querySelector('#register-error');
    const submitBtn = root.querySelector('#register-submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        errEl.classList.add('hidden');
        errEl.textContent = '';
        const name = form.name.value.trim();
        const email = form.email.value.trim();
        const password = form.password.value;
        const password_confirmation = form.password_confirmation.value;
        const role = form.role.value;
        if (password !== password_confirmation) {
            errEl.textContent = 'Passwords do not match.';
            errEl.classList.remove('hidden');
            return;
        }
        submitBtn.disabled = true;
        try {
            await auth.register({ name, email, password, password_confirmation, role });
            navigate('/dashboard');
        } catch (err) {
            const data = err.response?.data;
            const msg = data?.message || (data?.errors && Object.values(data.errors).flat().join(' ')) || 'Registration failed.';
            errEl.textContent = msg;
            errEl.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
        }
    });
}
