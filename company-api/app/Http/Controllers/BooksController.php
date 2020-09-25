<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function index(Book $book)
    {
        return response()->json(Book::all());
    }
}
