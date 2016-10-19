<?php

namespace App\Http\Controllers;


use App\Book;
use App\Genre;
use App\Http\Requests;
use DB;
use App\Dep;
use Request;


class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       $sql='';
        $deps = Dep::all();
        $books = Book::paginate(3);
        $genres = Genre::all();
        return view('book.index', ['books' => $books, 'deps' => $deps, 'genres' => $genres, 'sql' => $sql]);
    }
    
    static function show($id)
    {
        $deps = Dep::all();
        $book = Book::find($id);
        return view('book.content', ['book' => $book, 'deps' => $deps]);
    }
    
    public function filter(Request $request)
    {
        $sort = Request::has('sort') ? Request::get('sort') : false; // Параметр сортировки 'ASC','DESC'
        $order_by = Request::has('order_by') ? Request::get('order_by'): false;    // столбец сортировки
        $genre_id = Request::has('genre_id') ? Request::get('genre_id') : false; //Какой жанр книги
        $dep_id = Request::has('dep_id') ? Request::get('dep_id') :false;// Какой тематики книги
         
        $column = '';       
        if($sort) $param = $sort;
        if($order_by) $column = $order_by;
        
        $where = [];
        if($genre_id)
        {
            $where['genre_id'] = intval($genre_id);   
        }
        
        $books = Book::where($where)->orderBy($column, $param)->get();
        
        if($dep_id)
        {
            $books = Book::join('recomends', 'books.id', '=', 'recomends.book_id')
                    ->where('recomends.status', '=', 1)
                    ->where('recomends.dep_id', '=', $dep_id)
                    ->orWhere('recomends.dep_id', '=', -1)
                    ->orderBy($column, $param)
                    ->get();
        }
             
        $deps = Dep::all();
        $genres = Genre::all();
        return view('book.index', ['books' => $books, 'deps' => $deps, 'genres' => $genres]);
    }
}