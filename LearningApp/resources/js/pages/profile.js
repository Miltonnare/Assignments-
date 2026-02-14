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
    if (!auth.isAuthenticated || !auth.isFreelancer()) {
        navigate('/');
        return;
    }

    renderLayout(root, { content: '<div class="flex justify-center py-12"><span class="text-zinc-500">Loading…</span></div>' });

    try {
        const { data: profile } = await api.get('/freelancer/profile').catch(() => ({ data: null }));
        const content = `
            <div class="max-w-lg">
                <h1 class="text-2xl font-semibold mb-6">Freelancer profile</h1>
                <form id="profile-form" class="space-y-4">
                    <div>
                        <label for="bio" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">${esc(profile?.bio)}</textarea>
                    </div>
                    <div>
                        <label for="skills_summary" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Skills summary</label>
                        <textarea id="skills_summary" name="skills_summary" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">${esc(profile?.skills_summary)}</textarea>
                    </div>
                    <div>
                        <label for="hourly_rate" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Hourly rate ($)</label>
                        <input type="number" id="hourly_rate" name="hourly_rate" min="0" step="0.01" value="${profile?.hourly_rate ?? ''}"
                            class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div id="profile-form-error" class="text-red-600 dark:text-red-400 text-sm hidden"></div>
                    <button type="submit" id="profile-submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">Save profile</button>
                </form>
            </div>
        `;
        root.querySelector('main').innerHTML = content;

        const form = root.querySelector('#profile-form');
        const errEl = root.querySelector('#profile-form-error');
        const submitBtn = root.querySelector('#profile-submit');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            errEl.classList.add('hidden');
            const payload = {
                bio: form.bio.value.trim() || null,
                skills_summary: form.skills_summary.value.trim() || null,
                hourly_rate: form.hourly_rate.value ? parseFloat(form.hourly_rate.value) : null,
            };
            submitBtn.disabled = true;
            try {
                await api.post('/freelancer/profile', payload);
                errEl.classList.remove('hidden');
                errEl.textContent = '';
                errEl.classList.add('text-emerald-600', 'dark:text-emerald-400');
                errEl.textContent = 'Profile saved.';
                errEl.classList.remove('hidden');
            } catch (err) {
                const data = err.response?.data;
                errEl.textContent = data?.message || (data?.errors && Object.values(data.errors).flat().join(' ')) || 'Failed to save.';
                errEl.classList.remove('text-emerald-600', 'dark:text-emerald-400');
                errEl.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
            }
        });
    } catch (e) {
        root.querySelector('main').innerHTML = `<div class="text-red-600 dark:text-red-400">Could not load profile.</div>`;
    }
}
