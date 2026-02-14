const exactRoutes = new Map();
const patternRoutes = [];
let currentCleanup = null;

export function define(path, handler) {
    if (path.includes(':')) {
        const parts = path.replace(/^\//, '').split('/');
        const re = new RegExp('^/' + parts.map((p) => (p.startsWith(':') ? '([^/]+)' : p.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'))).join('/') + '$');
        patternRoutes.push({ re, handler });
    } else {
        exactRoutes.set(path, handler);
    }
}

export function getPath() {
    const hash = window.location.hash.slice(1) || '/';
    const [path] = hash.split('?');
    return path.startsWith('/') ? path : `/${path}`;
}

export function navigate(path) {
    window.location.hash = path.startsWith('/') ? path : `/${path}`;
}

function findHandler(path) {
    const normalized = path === '' ? '/' : (path.startsWith('/') ? path : `/${path}`);
    const exact = exactRoutes.get(normalized);
    if (exact) return exact;
    for (const { re, handler } of patternRoutes) {
        if (re.test(normalized)) return handler;
    }
    return exactRoutes.get('*');
}

export function run(root, path = getPath()) {
    const normalized = path === '' ? '/' : (path.startsWith('/') ? path : `/${path}`);
    const handler = findHandler(normalized);
    if (currentCleanup) {
        currentCleanup();
        currentCleanup = null;
    }
    if (!handler) {
        root.innerHTML = '<div class="p-8 text-center text-zinc-500">Page not found.</div>';
        return;
    }
    const cleanup = handler(root, normalized);
    if (typeof cleanup === 'function') {
        currentCleanup = cleanup;
    }
}

export function init(root) {
    run(root, getPath());
    window.addEventListener('hashchange', () => run(root, getPath()));
}
