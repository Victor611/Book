<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;
use App\Genre;
use App\Link;
use App\Rating;
use App\Recomend;
use App\Logger;


use Image;
use Illuminate\Support\Facades\Validator;

class BookModerController extends Controller
{
    protected $layout = 'layouts.moder';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
// Главная   
    public function index()
    {
        $books = Book::all();
        return view('moder_book.index', ['books' => $books]);
    }
    
// Форма Add new book   
    public function create()
    {
        $genres = Genre::all();
        return view('moder_book.create', ['genres' => $genres]);
    }
// save new book
    public function save(Request $request)
    {
        
        $validator = BookModerController::check($request);        
        if ($validator->fails())
        {
            return redirect('/moder/create/book')
                ->withInput()
                ->withErrors($validator);
        }
        
        
            $data = new Book;
            if($request->hasFile('avatar'))
            {
                $book_avatar = $request->file('avatar');
                $filename = time() .'.'. $book_avatar->getClientOriginalExtension();
                Image::make($book_avatar)->save(public_path('uploads/book_avatar/'.$filename));
                $data->avatar = $filename;
            }
            $data->title = $request->title;
            $data->author = $request->author;
            $data->pubyear = $request->pubyear;
            $data->description = $request->description;
            $data->genre_id = $request->genre_id;
            $data->type = $request->type;
            $data->save();
            Logger::write(Logger::$book, $data->id, 'create');
            
            return redirect('/moder/book');
        
    }
// форма редактирования книги    
    public function edit($id)
    {
        $genres = Genre::all();
        $book = Book::find($id);
        return view('moder_book.edit',['book' => $book, 'genres' => $genres]);
        
    }
//Обновить книгу
    public function update(Request $request, $id)
    {
        $validator = BookModerController::check($request);
        if ($validator->fails())
        {
            return redirect('/moder/edit/book/'.$id)
                ->withInput()
                ->withErrors($validator);
        }
        

        $data = Book::find($id);
            if($request->hasFile('avatar'))
            {
                $book_avatar = $request->file('avatar');
                $filename = time() .'.'. $book_avatar->getClientOriginalExtension();
                Image::make($book_avatar)->save(public_path('uploads/book_avatar/'.$filename));
                $data->avatar = $filename;
            }
        $data->title = $request->title;
        $data->author = $request->author;
        $data->pubyear = $request->pubyear;
        $data->description = $request->description;
        $data->genre_id = $request->genre_id;
        $data->type = $request->type;
        $data->save();
        Logger::write(Logger::$book, $data->id, 'update');
        return redirect('/moder/book');
    }
// Удалить книгу    
    public function delete($id)
    {
        $book = Book::find($id);
        $book->coment()->delete();
        $book->rating()->delete();
        $book->link()->delete();
        $book->recomend()->delete();
        $book->delete();
        Logger::write(Logger::$book, $id, 'delete');
        return redirect('/moder/book'); 
    }
    
    public function check(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'pubyear' => 'required|numeric|min:1900|max:2050',
            'description' => 'required|max:255',
            'genre_id' => 'required|max:255',
            'type' => 'required|max:30',
            'avatar' => 'image|mimes:jpeg,bmp,png',
        ]);        
    }
}
