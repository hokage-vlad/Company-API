<template>
  <div class="container">
    <div class="row">
      <div class="m-auto col-lg-6">
        <div v-if="errors" class="bg-danger mb-3">
          <div v-for="(error , key) in errors" :key="key">
            <span class="text-white" v-text="error[0]"></span><br>
          </div>
        </div>
        <form>
          <h2 class="text-center">Log in</h2>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" required="required" v-model="login.email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required"
                   v-model="login.password">
          </div>
          <div class="form-group">
            <button @click.prevent="loginUser" type="submit" class="btn btn-success btn-block">Log in</button>
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
      login: {
        email: '',
        password: '',
      },
      errors: [],
    }
  },

  methods: {
    loginUser() {
      Api().post('/login', this.login).then((response) => {
        this.$store.commit("LOGIN_USER", true);
        localStorage.setItem("token", response.data);
        this.$router.push({path: '/books'});
        this.$router.go();
      }).catch(error => {
        this.errors = error.response.data.errors;
      });
    },
  }
}
</script>

<style>

</style>