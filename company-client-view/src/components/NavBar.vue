<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark mb-lg-3">
            <a class="navbar-brand text-white font-weight-bold" href="#">Book Library</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link text-white" to="/">Home</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link v-if="!isLoggedIn"  to="/login"><span class="nav-link text-white">Login</span></router-link>
                    </li>

                    <li class="nav-item">
                        <router-link v-if="!isLoggedIn"  to="/register"><span class="nav-link text-white">Register</span></router-link>
                    </li>

                    <li class="nav-item">
                        <router-link v-if="isLoggedIn"  to="/books"><span class="nav-link text-white">Books</span></router-link>
                    </li>

                </ul>

                <div v-if="isLoggedIn" class="ml-auto">
                    <ul class="navbar-nav">
                        <li><h5 class="nav-item nav-link text-warning mb-0">Hello, {{ user.name }}</h5></li>
                        <span class="nav-item nav-link text-white font-weight-bold">|</span>
                        <li><a class="nav-item nav-link text-danger font-weight-bold" v-if="isLoggedIn" @click.prevent="logoutUser">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>

    import { mapGetters } from "vuex";
    import { mapState } from "vuex";
    import Api from '../api-connect/Api'

    export default {
        computed: {
            ...mapGetters(["isLoggedIn"]),
            ...mapState({
                user: state => state.auth.user
            })
        },

        mounted() {
            let token = localStorage.getItem("token");
            if(token){
               Api().get('/user').then(response => {
                   this.$store.commit("AUTH_USER", response.data);
               });
            }
        },

        methods: {
            logoutUser() {
                Api().post('/logout').then(() => {
                    localStorage.removeItem("token");
                    this.$store.commit("LOGIN_USER", false);
                    this.$router.push({ path: "/" });
                });
            }
        }
    };
</script>