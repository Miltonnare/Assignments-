import api from './api.js';

const STORAGE_TOKEN = 'token';
const STORAGE_USER = 'user';

function getUser() {
    try {
        const raw = localStorage.getItem(STORAGE_USER);
        return raw ? JSON.parse(raw) : null;
    } catch {
        return null;
    }
}

function setUser(user) {
    if (user) {
        localStorage.setItem(STORAGE_USER, JSON.stringify(user));
    } else {
        localStorage.removeItem(STORAGE_USER);
    }
}

function getToken() {
    return localStorage.getItem(STORAGE_TOKEN);
}

function setToken(token) {
    if (token) {
        localStorage.setItem(STORAGE_TOKEN, token);
    } else {
        localStorage.removeItem(STORAGE_TOKEN);
    }
}

export const auth = {
    get user() {
        return getUser();
    },
    get token() {
        return getToken();
    },
    get isAuthenticated() {
        return !!getToken();
    },
    isFreelancer() {
        const u = getUser();
        return u?.role === 'freelancer';
    },
    isClient() {
        const u = getUser();
        return u?.role === 'client';
    },
    isAdmin() {
        const u = getUser();
        return u?.role === 'admin';
    },

    async register({ name, email, password, password_confirmation, role }) {
        const { data } = await api.post('/auth/register', {
            name,
            email,
            password,
            password_confirmation,
            role,
        });
        setToken(data.token);
        setUser(data.user);
        return data;
    },

    async login({ email, password }) {
        const { data } = await api.post('/auth/login', { email, password });
        setToken(data.token);
        setUser(data.user);
        return data;
    },

    async fetchMe() {
        const { data } = await api.get('/auth/me');
        setUser(data);
        return data;
    },

    logout() {
        api.post('/auth/logout').catch(() => {});
        setToken(null);
        setUser(null);
    },
};

window.addEventListener('auth:logout', () => {
    setToken(null);
    setUser(null);
});
