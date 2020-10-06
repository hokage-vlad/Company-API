import VueRouter from 'vue-router'
import Books from './components/Books';
import Register from './components/Register';
import Login from './components/Login';
import Home from './components/Home';


export default new VueRouter({

    routes: [
        {
            path: '/',
            component: Home,
        },

        {
            path: '/books',
            component: Books,
        },

        {
            path: '/register',
            component: Register
        },

        {
            path: '/login',
            component: Login,
        },
    ],
    mode: 'history'

});