<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'Books',
  props: {
    msg: String
  },

  data(){
    return {

    }
  },
  mounted() {
    this.getBooks();
  },
  methods:{
    getBooks(){
      axios.get('http://127.0.0.1:8000/api/books').then((response)=>{
        console.log(response);
      }).catch((error)=>{
        console.log(error);
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
