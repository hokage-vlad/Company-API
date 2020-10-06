<template>
    <div class="container">
        <div class="row">
            <div class="m-auto col-lg-6">
                <div v-if="errors" class="bg-danger mb-3">
                    <div v-for="(error , key) in errors" :key="key">
                        <span class="text-white" v-text="error[0]"></span><br>
                    </div>
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
    import Api from '../api-connect/Api'

    export default {
        data() {
            return {
                register: {
                    name: '',
                    email: '',
                    password: '',
                },
                errors: [],
            }
        },

        methods: {

            registerUser() {
                Api().post('/register', this.register).then(response => {
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