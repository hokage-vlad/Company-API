<template>
    <div class="container">
        <div class="row">
            <div class="m-auto col-lg-6">
                <div v-if="errors">
                    <span class="text-danger" v-text="errors.name[0]"></span><br>
                    <span class="text-danger" v-text="errors.password[0]"></span><br>
                    <span class="text-danger" v-text="errors.email[0]"></span><br>
                </div>
                <form  @submit.prevent="registerUser">
                    <h2 class="text-center">Sign up</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" required="required" v-model="register.name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required="required" v-model="register.email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required="required" v-model="register.password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Sign in</button>
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
                register: {
                    name: '',
                    email: '',
                    password: '',
                },
                errors: '',
            }
        },

        methods: {

            registerUser() {
                axios.post('http://127.0.0.1:8000/api/register', this.register).then(response => {
                    this.success = response.data.success;
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
        }
    }
</script>

<style scoped>

</style>