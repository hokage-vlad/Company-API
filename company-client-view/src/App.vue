<template>
    <div id="app">
        <Navbar></Navbar>
        <router-view/>
    </div>
</template>

<script>
    import Navbar from './components/NavBar'
    import axios from 'axios';

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
        methods: {
          index(){
            axios.get('http://127.0.0.1:8000/api/auth').then(response => {
                this.user = response.data.user;
            })
          }
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
