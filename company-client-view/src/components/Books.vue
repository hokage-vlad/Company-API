<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <div v-if="errors">
            <span style="color:red" v-text="errors.name[0]"></span><br>
            <span style="color:red" v-text="errors.author[0]"></span>
        </div>
        <form @submit.prevent="addBook">
            <input type="text" placeholder="Book Name" v-model="book.name">
            <input type="text" placeholder="Book Author" v-model="book.author">
            <input type="number" placeholder="Book Price" v-model="book.price">
            <button>Add</button>
        </form>
        <div v-for="(book , key) in books" :key="key">
            <table border="1">
                <ul>
                    <form @submit.prevent="editBook(book)">
                        <li>{{book.id}}</li>
                        <li>{{book.name}} <input type="text" placeholder="Book Name" v-model="book.name"></li>
                        <li>{{book.author}} <input type="text" placeholder="Book Author" v-model="book.author">
                        </li>
                        <li>{{book.price}} <input type="number" placeholder="Book Price" v-model="book.price">
                        </li>
                        <li>{{book.created_at}}</li>
                        <button>Update</button>
                    </form>
                    <td>
                        <button v-on:click="removeBook(book)">🗑</button>
                    </td>
                </ul>
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
                books: [],
                book: {
                    name: '',
                    author: '',
                    price: '',
                },
                errors: '',

            }
        },
        mounted() {
            this.getBooks();
        },
        methods: {
            addBook() {
                axios.post('http://127.0.0.1:8000/api/books', this.book).then(response => {
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

            removeBook(book) {
                axios.delete('http://127.0.0.1:8000/api/books/' + book.id).then((response) => {
                    this.success = response.data.success;
                    this.getBooks()
                }).catch((error) => {
                    console.log(error);
                })
            },

            editBook(book) {
                axios.put('http://127.0.0.1:8000/api/books/' + book.id, book).then((response) => {
                    this.success = response.data.success;
                    this.getBooks()
                    console.log(response.data);
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
