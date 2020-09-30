<template>
    <div id="app">
        <Navbar></Navbar>
        <Books msg="Books App"/>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navbar from './components/NavBar'
    import Books from './components/Books.vue'

    export default {
        name: 'App',
        components: {
            Navbar,
            Books
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
