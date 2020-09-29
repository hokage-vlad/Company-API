<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <div v-if="errors">
            <span class="text-danger" v-text="errors.name[0]"></span><br>
            <span class="text-danger" v-text="errors.author[0]"></span>
        </div>
        <form @submit.prevent="addBook" class="m-4">
            <input type="text" placeholder="Book Name" v-model="book.name">
            <input type="text" placeholder="Book Author" v-model="book.author">
            <input type="number" placeholder="Book Price" v-model="book.price">
            <button class="btn-success">Add</button>
        </form>
            <div v-if="books.length != 0">
            <div v-for="(book , key) in books" :key="key">
                <table class="m-auto">
                    <tr>
                        <td class="d-flex">
                        <form @submit.prevent="editBook(book)">
                            <table class="table-bordered">
                                <tr>
                                    <td class="p-3"><span class="font-weight-bold">Id:</span> {{book.id}}</td>
                                    <td class="p-3"><span class="font-weight-bold">Name:</span> {{book.name}} <input v-if="isActive === key" type="text" placeholder="Book Name" v-model="book.name"></td>
                                    <td class="p-3"><span class="font-weight-bold">Autor:</span> {{book.author}} <input v-if="isActive === key" type="text" placeholder="Book Author" v-model="book.author"></td>
                                    <td class="p-3"><span class="font-weight-bold">Price:</span> {{book.price}} <input v-if="isActive === key" type="number" placeholder="Book Price" v-model="book.price"></td>
                                    <td class="p-3"><span class="font-weight-bold">Date:</span> {{book.created_at.substring(0,10)}}</td>

                                <div v-if="isActive !== key">
                                    <td><a class="btn btn-info text-white p-3" v-on:click="toggleItem(key)" v-bind="{active: isActive === key}">Edit</a></td>
                                </div>
                                <div v-if="isActive === key">
                                    <td> <button class="btn btn-warning p-3">Update</button></td>
                                    <td><a class="btn btn-a p-3" v-on:click="toggleItem(null)">Close</a></td>
                                </div>
                                </tr>
                            </table>
                        </form>

                            <form @submit.prevent="removeBook(book)">
                                <table class="table-bordered ">
                                    <tr>
                                        <td><button class="btn btn-danger text-white p-3">X</button></td>
                                    </tr>
                                </table>
                            </form>

                        </td>
                    </tr>

                </table>
            </div>
            </div>
            <div v-else>
                <span class="h2"> Empty 😔 </span>
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
                isActive: false,
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
            toggleItem(index) {
                this.isActive = index;
            },

            addBook() {
                axios.post('http://127.0.0.1:8000/api/books', this.book).then(response => {
                    this.success = response.data.success;
                    this.getBooks()
                }).catch(error => {
                    this.errors = error.response.data.errors;
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
