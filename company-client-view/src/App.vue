<template>
    <div id="app">
        <Navbar></Navbar>
        <router-view/>
    </div>
</template>

<script>
    import Navbar from './components/NavBar'

    export default {
        name: 'App',
        components: {
            Navbar,
        },

        data() {
            return {
                user: null,
            }
        },
        mounted() {
            this.$store.commit("LOGIN_USER", !!localStorage.getItem("token"));
        }
    }
</script>

<style>
    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
    }
</style>
