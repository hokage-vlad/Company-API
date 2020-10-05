<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark mb-lg-5">
            <a class="navbar-brand text-white" href="#">Book Library</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="#">Home <span class="sr-only">(current)</span></a>
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

                    <li class="nav-item">
                        <a class="nav-item nav-link text-danger font-weight-bold" v-if="isLoggedIn" @click.prevent="logoutUser">Logout</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    {{user.name}}
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
</template>

<script>
    import axios from 'axios';
    import { mapGetters } from "vuex";
    import { mapState } from "vuex";

    export default {
        computed: {
            ...mapGetters(["isLoggedIn"]),
            ...mapState({
                user: state => state.auth.user
            })
        },

        mounted() {
            axios.get('http://127.0.0.1:8000/api/user').then(response => {
                this.$store.commit("AUTH_USER", response.data);
            });
        },

        methods: {
            logoutUser() {
                axios.post('http://127.0.0.1:8000/api/logout').then(() => {
                    localStorage.removeItem("token");
                    this.$store.commit("LOGIN_USER", false);
                    this.$router.push({ path: "/" });
                });
            }
        }
    };
</script>