<template>
    <div class="container">
        <div class="row">
            <div class="m-auto col-lg-6">
                <div v-if="errors" class="bg-danger mb-3">
                    <div v-for="(error , key) in errors" :key="key">
                        <span class="text-white" v-text="error[0]"></span><br>
                    </div>
                </div>
            <form @submit.prevent="loginUser">
                <h2 class="text-center">Log in</h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" required="required" v-model="login.name">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="required" v-model="login.password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Log in</button>
                </div>
                <div class="clearfix">
                    <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                    <a href="#" class="float-right">Forgot Password?</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                login: {
                    name: '',
                    password: '',
                },
                errors: [],
            }
        },

        methods: {

            loginUser() {
                axios.post('http://127.0.0.1:8000/api/login', this.login).then(() =>
                    this.$router.push({ path: '/books'
                })).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
        }
    }
</script>

<style>

</style>