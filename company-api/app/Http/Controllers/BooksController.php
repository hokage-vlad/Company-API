<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class BooksController extends Controller
{

    public function index()
    {
        $book = Book::all();
        return response()->json($book);
    }

    public function store(Book $book, Request $request)
    {
        $book->create($request->all());
    }

    public function destroy(Book $book)
    {
        $book->delete();
    }
}
