<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;

class BookAdminController extends Controller
{
    protected $layout = 'layouts.admin';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
// Главная   
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin_book.index', ['books' => $books]);
    }
}
