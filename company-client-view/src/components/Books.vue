<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <div v-if="errors">
      <span class="text-danger" v-text="errors.name[0]"></span><br>
      <span class="text-danger" v-text="errors.author[0]"></span>
    </div>
    <div class="m-1">
      <input class="mr-4" type="text" placeholder="Search" aria-label="Search" v-model="search">
      <button class="btn btn-outline-success" type="submit" v-on:click="searchBooks">Search</button>
    </div>
    <div v-for="(searchBook , key) in searchedBooks" :key="key">
      <table class="m-auto">
        <tr>
          <td class="d-flex">
            <form @submit.prevent="editBook(book)">
              <table class="table-bordered">
                <tr>
                  <td class="p-3"><span class="font-weight-bold">Id:</span> {{ searchBook.id }}</td>
                  <td class="p-3"><span class="font-weight-bold">Name:</span> {{ searchBook.name }} <input
                      v-if="isActive === key" type="text" placeholder="Book Name" v-model="searchedBook.name"></td>
                  <td class="p-3"><span class="font-weight-bold">Autor:</span> {{ searchBook.author }} <input
                      v-if="isActive === key" type="text" placeholder="Book Author" v-model="searchedBook.author"></td>
                  <td class="p-3"><span class="font-weight-bold">Price:</span> {{ searchBook.price }} <input
                      v-if="isActive === key" type="number" placeholder="Book Price" v-model="searchedBook.price"></td>
                  <td class="p-3"><span class="font-weight-bold">Date:</span>
                    {{ searchBook.created_at.substring(0, 10) }}
                  </td>

                  <div v-if="isActive !== key">
                    <td><a class="btn btn-info text-white p-3" v-on:click="toggleItem(key)"
                           v-bind="{active: isActive === key}">Edit</a></td>
                  </div>
                  <div v-if="isActive === key">
                    <td>
                      <button class="btn btn-warning p-3">Update</button>
                    </td>
                    <td><a class="btn btn-a p-3" v-on:click="toggleItem(null)">Close</a></td>
                  </div>
                </tr>
              </table>
            </form>

            <form @submit.prevent="removeBook(searchBook)">
              <table class="table-bordered ">
                <tr>
                  <td>
                    <button class="btn btn-danger text-white p-3">X</button>
                  </td>
                </tr>
              </table>
            </form>

          </td>
        </tr>

      </table>
    </div>
    <hr>
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
                    <td class="p-3"><span class="font-weight-bold">Id:</span> {{ book.id }}</td>
                    <td class="p-3"><span class="font-weight-bold">Name:</span> {{ book.name }} <input
                        v-if="isActive === key" type="text" placeholder="Book Name" v-model="book.name"></td>
                    <td class="p-3"><span class="font-weight-bold">Autor:</span> {{ book.author }} <input
                        v-if="isActive === key" type="text" placeholder="Book Author" v-model="book.author"></td>
                    <td class="p-3"><span class="font-weight-bold">Price:</span> {{ book.price }} <input
                        v-if="isActive === key" type="number" placeholder="Book Price" v-model="book.price"></td>
                    <td class="p-3"><span class="font-weight-bold">Date:</span> {{ book.created_at.substring(0, 10) }}
                    </td>

                    <div v-if="isActive !== key">
                      <td><a class="btn btn-info text-white p-3" v-on:click="toggleItem(key)"
                             v-bind="{active: isActive === key}">Edit</a></td>
                    </div>
                    <div v-if="isActive === key">
                      <td>
                        <button class="btn btn-warning p-3">Update</button>
                      </td>
                      <td><a class="btn btn-a p-3" v-on:click="toggleItem(null)">Close</a></td>
                    </div>
                  </tr>
                </table>
              </form>

              <form @submit.prevent="removeBook(book)">
                <table class="table-bordered ">
                  <tr>
                    <td>
                      <button class="btn btn-danger text-white p-3">X</button>
                    </td>
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
import Api from '../api-connect/Api';

export default {
  props: {
    msg: ''
  },

  data() {
    return {
      isActive: false,
      books: [],
      searchedBooks: [],
      searchBook: {
        name: '',
        author: '',
        price: '',
      },
      book: {
        name: '',
        author: '',
        price: '',
      },
      errors: '',
      search: '',

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
      Api().post('/books', this.book).then(response => {
        this.success = response.data.success;
        this.getBooks()
      }).catch(error => {
        this.errors = error.response.data.errors;
      });
    },

    searchBooks() {
      Api().get('/books/search?val=' + this.search).then((response) => {
        this.searchedBooks = response.data;
      }).catch((error) => {
        console.log(error);
      })
    },

    getBooks() {
      Api().get('/books').then((response) => {
        this.books = response.data;
      }).catch((error) => {
        console.log(error);
      })
    },

    removeBook(book) {
      Api().delete('/books/' + book.id).then((response) => {
        this.success = response.data.success;
        this.searchBooks();
        this.getBooks()
      }).catch((error) => {
        console.log(error);
      })
    },

    editBook(book) {
      Api().put('/books/' + book.id, book).then((response) => {
        this.success = response.data.success;
        this.getBooks()
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
