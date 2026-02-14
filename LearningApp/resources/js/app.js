import './bootstrap';
import { define, init } from './router.js';
import { auth } from './auth.js';
import { navigate } from './router.js';

import { render as home } from './pages/home.js';
import { render as login } from './pages/login.js';
import { render as register } from './pages/register.js';
import { render as dashboard } from './pages/dashboard.js';
import { render as profile } from './pages/profile.js';

import { render as servicesList } from './pages/services.js';
import { render as serviceDetail } from './pages/serviceDetail.js';
import { render as serviceForm } from './pages/serviceForm.js';

import { render as jobsList } from './pages/jobs.js';
import { render as jobDetail } from './pages/jobDetail.js';
import { render as jobForm } from './pages/jobForm.js';

import { render as ordersList } from './pages/orders.js';
import { render as orderDetail } from './pages/orderDetail.js';

define('/', home);
define('/login', login);
define('/register', register);
define('/dashboard', dashboard);
define('/profile', profile);

define('/services', servicesList);
define('/services/new', serviceForm);
define('/services/:id/edit', serviceForm);
define('/services/:id', serviceDetail);

define('/jobs', jobsList);
define('/jobs/new', jobForm);
define('/jobs/:id/edit', jobForm);
define('/jobs/:id', jobDetail);

define('/orders', ordersList);
define('/orders/:id', orderDetail);

define('*', (root) => {
    root.innerHTML = '<div class="p-8 text-center text-zinc-500">Page not found. <a href="#/" class="text-emerald-600 hover:underline">Home</a></div>';
});

window.addEventListener('auth:logout', () => {
    navigate('/');
});

const root = document.getElementById('app');
if (root) {
    init(root);
}
