import Vue from 'vue'
import App from './App.vue'
//import Axios from 'axios'

Vue.config.productionTip = false

//Axios.default.baseUrl = 'http://127.0.0.1:8000';

new Vue({
  render: h => h(App),
}).$mount('#app')
