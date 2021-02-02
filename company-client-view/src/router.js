import VueRouter from 'vue-router'
import Books from './components/Books';
import Register from './components/Register';
import Login from './components/Login';
import Home from './components/Home';

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: Home,
        },

        {
            path: '/books',
            component: Books,
            beforeEnter(to, from, next) {
                if (!isLoggedIn(to)) {
                    next('/login');
                } else {
                    next();
                }
            }
        },

        {
            path: '/register',
            component: Register,
            beforeEnter(to, from, next) {
                if (isLoggedIn(to)) {
                    next('/books');
                } else {
                    next();
                }
            }
        },

        {
            path: '/login',
            component: Login,
            beforeEnter(to, from, next) {
                if (isLoggedIn(to)) {
                    next('/books');
                }
                next();
            }
        },
    ],

    mode: 'history',
});

function isLoggedIn() {
    return localStorage.getItem("token");
}

export default router;