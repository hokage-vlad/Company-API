<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <div v-if="errors">
                <span style="color:red" v-text="errors.name[0]" ></span><br>
                <span style="color:red" v-text="errors.author[0]" ></span>
        </div>
        <form @submit.prevent="addBook">
            <input type="text" placeholder="Book Name" name="name" v-model="name">
            <input type="text" placeholder="Book Author" name="author" v-model="author">
            <input type="number" placeholder="Book Price" name="price" v-model="price">
            <button>Add</button>
        </form>
        <div v-for="(book , key) in books" :key="key">
            <table border="1">
                <tr>
                    <td>{{book.id}}</td>
                    <td>{{book.name}}</td>
                    <td>{{book.author}}</td>
                    <td>{{book.price}}</td>
                    <td>{{book.created_at}}</td>
                    <td>
                        <button v-on:click="removeBook(book.id, key)">🗑</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            msg: String
        },

        data() {
            return {
                errors: '',
                books: {},
                name: '',
                author: '',
                price: ''
            }
        },
        mounted() {
            this.getBooks();
        },
        methods: {
            addBook() {
                axios.post('http://127.0.0.1:8000/api/books', {
                    name: this.name,
                    author: this.author,
                    price: this.price,
                }).then(response => {
                    this.success = response.data.success;
                    this.getBooks()
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    console.log(error.response)
                });
            },

            getBooks() {
                axios.get('http://127.0.0.1:8000/api/books').then((response) => {
                    this.books = response.data;
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                })
            },

            removeBook(id) {
                axios.delete('http://127.0.0.1:8000/api/books/' + id).then((response) => {
                    this.books = response.data;
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                })
            }
        }
    }
</script>

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
