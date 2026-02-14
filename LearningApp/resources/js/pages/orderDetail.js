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
    const id = path.replace('/orders/', '');
    if (!id) {
        navigate('/orders');
        return;
    }

    renderLayout(root, { content: '<div class="flex justify-center py-12"><span class="text-zinc-500">Loading…</span></div>' });

    try {
        const { data: order } = await api.get(`/orders/${id}`);
        const canChangeStatus = order.client_id === auth.user?.id || order.freelancer_id === auth.user?.id || auth.isAdmin();
        const isClient = order.client_id === auth.user?.id;
        const canReview = isClient && order.status === 'completed' && !order.review;

        let statusBlock = '';
        if (canChangeStatus && order.status !== 'completed' && order.status !== 'cancelled') {
            statusBlock = `
                <div class="mt-6 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <label for="order-status" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Update status</label>
                    <select id="order-status" class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100">
                        <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                        <option value="active" ${order.status === 'active' ? 'selected' : ''}>Active</option>
                        <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                        <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                    </select>
                    <button type="button" id="order-status-btn" class="ml-2 px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">Update</button>
                </div>
            `;
        }

        let reviewBlock = '';
        if (canReview) {
            reviewBlock = `
                <div class="mt-6 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <h3 class="font-medium mb-2">Leave a review</h3>
                    <form id="review-form" class="space-y-2">
                        <div>
                            <label for="rating" class="block text-sm text-zinc-600 dark:text-zinc-400">Rating (1-5)</label>
                            <select id="rating" name="rating" required class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div>
                            <label for="comment" class="block text-sm text-zinc-600 dark:text-zinc-400">Comment (optional)</label>
                            <textarea id="comment" name="comment" rows="2" class="w-full px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900"></textarea>
                        </div>
                        <button type="submit" id="review-submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">Submit review</button>
                    </form>
                    <div id="review-error" class="text-red-600 dark:text-red-400 text-sm mt-2 hidden"></div>
                </div>
            `;
        } else if (order.review) {
            reviewBlock = `<div class="mt-6 pt-6 border-t border-zinc-200 dark:border-zinc-700"><p class="text-zinc-600 dark:text-zinc-400">Your review: ${esc(order.review.rating)}/5 – ${esc(order.review.comment) || '—'}</p></div>`;
        }

        const content = `
            <div class="mb-6">
                <a href="#/orders" class="text-emerald-600 dark:text-emerald-400 hover:underline text-sm">← Back to orders</a>
            </div>
            <article class="max-w-2xl">
                <h1 class="text-2xl font-semibold mb-2">Order #${esc(order.id)}</h1>
                <p class="text-zinc-600 dark:text-zinc-400 mb-4">${order.service ? esc(order.service.title) : '—'}</p>
                <div class="flex flex-wrap gap-4 mb-2">
                    <span class="font-medium text-emerald-600 dark:text-emerald-400">$${Number(order.amount).toFixed(2)}</span>
                    <span class="px-2 py-0.5 rounded text-sm ${order.status === 'completed' ? 'bg-emerald-100 dark:bg-emerald-900/30' : order.status === 'cancelled' ? 'bg-red-100 dark:bg-red-900/30' : 'bg-zinc-100 dark:bg-zinc-800'}">${esc(order.status)}</span>
                </div>
                ${order.freelancer ? `<p class="text-sm text-zinc-500">Freelancer: ${esc(order.freelancer.name)}</p>` : ''}
                ${statusBlock}
                ${reviewBlock}
            </article>
        `;
        root.querySelector('main').innerHTML = content;

        const statusBtn = root.querySelector('#order-status-btn');
        if (statusBtn) {
            const statusSelect = root.querySelector('#order-status');
            statusBtn.addEventListener('click', async () => {
                statusBtn.disabled = true;
                try {
                    await api.patch(`/orders/${order.id}/status`, { status: statusSelect.value });
                    navigate(`/orders/${order.id}`);
                } catch (err) {
                    alert(err.response?.data?.message || 'Failed to update status.');
                } finally {
                    statusBtn.disabled = false;
                }
            });
        }

        const reviewForm = root.querySelector('#review-form');
        if (reviewForm) {
            const reviewError = root.querySelector('#review-error');
            const reviewSubmit = root.querySelector('#review-submit');
            reviewForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                reviewError.classList.add('hidden');
                reviewSubmit.disabled = true;
                try {
                    await api.post('/reviews', {
                        order_id: order.id,
                        rating: parseInt(reviewForm.rating.value, 10),
                        comment: reviewForm.comment.value.trim() || null,
                    });
                    navigate(`/orders/${order.id}`);
                } catch (err) {
                    const data = err.response?.data;
                    reviewError.textContent = data?.message || (data?.errors && Object.values(data.errors).flat().join(' ')) || 'Failed to submit review.';
                    reviewError.classList.remove('hidden');
                } finally {
                    reviewSubmit.disabled = false;
                }
            });
        }
    } catch (e) {
        root.querySelector('main').innerHTML = `<div class="text-red-600 dark:text-red-400">Order not found.</div>`;
    }
}
