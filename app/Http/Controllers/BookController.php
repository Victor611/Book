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
    public $itemsPerPage = 10;
    
    public function index()
    {
        $deps = Dep::all();
        $books = Book::orderBy('avg_rating', 'DESC')->orderBy('count_coment', 'DESC')->paginate($this->itemsPerPage);
        $genres = Genre::orderBy('priority', 'ASC')->get();
        return view('book.index', ['books' => $books, 'deps' => $deps, 'genres' => $genres]);
    }
    
    static function show($id)
    {
        $deps = Dep::all();
        $book = Book::findOrFail($id);
        return view('book.content', ['book' => $book, 'deps' => $deps]);
    }
    
    public function filter(Request $request)
    {
       
        $sort = Request::has('sort') ? Request::get('sort') : false; 
        $column = "avg_rating";
        $order = null;
        if($sort)
        {
            list($column, $order) = explode("::", $sort);
        }    
            
            
        $books = Book::leftJoin('recomends', 'books.id', '=', 'recomends.book_id')->where( function($query)
        {    
            $genres = Request::has('genres') ? Request::get('genres') : []; //Какой жанр книги
            $deps = Request::has('deps') ? Request::get('deps') :false;
            
            $where = [];
        
            if($deps)
            {
                $query->where('recomends.dep_id', '=', -1);
                $query->orWhere(function ($q) use($deps)
                {
                    foreach($deps as $dep_id)
                    {
                        $q->orWhere('recomends.dep_id', '=', $dep_id);
                    }
                });
            }
            
            if($genres)
            {
                $query->where(function ($q) use ($genres)
                {
                    foreach($genres as $genre_id)
                    {
                       $q->orWhere('genre_id', '=', $genre_id);
                    }
                });
            } 
                 
        })
        ->orderBy('books.'.$column, $order)
        ->groupBy('id')
        //->toSql();
        //dd($books); exit;
        ->paginate($this->itemsPerPage);
       
        return view('book.index', [
                        'books' => $books,
                        'deps' => Dep::all(),
                        'genres' => Genre::orderBy('priority', 'ASC')->get(),
                        'deps_r' => Request::get('deps'),
                        'genres_r' => Request::get('genres'),
        ]);
    }
}
