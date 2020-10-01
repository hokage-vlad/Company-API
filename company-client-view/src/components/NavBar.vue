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
                        <a class="nav-link text-white" href="#"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu text-white" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <router-link to="/books"><span class="nav-link text-white">Books</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/login"><span class="nav-link text-white">Login</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/register"><a class="nav-link text-white">Register</a></router-link>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    {{name}}
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        created() {
            this.getUser();
        },

        data() {
            return {
                name: ''
            }
        },

        methods: {
            getUser() {
                axios.get('http://127.0.0.1:8000/api/user').then((response) => {
                    this.name = response.data.name;
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
        }
    }
</script>