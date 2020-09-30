import Books from "./components/Books";
import Register from './components/Register';
import Login from './components/Login';

export default [
    {
        path: '/books',
        component: Books,
        name: 'books'
    },

    {
        path: '/register',
        component: Register
    },

    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
]