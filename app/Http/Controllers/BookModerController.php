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
use Storage;
use Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use DB;

class BookModerController extends Controller
{
    protected $layout = 'layouts.moder';

// Главная   
    public function index()
    {
        $books = Book::paginate(10);
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
        
        $validator_ru = BookModerController::checkBookRu($request);
        $validator = BookModerController::checkBook($request);        
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
			$img=Image::make($book_avatar);
            $img->resize(180, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('uploads/book_avatar/'.$filename));
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
        $book = Book::findOrFail($id);
        return view('moder_book.edit',['book' => $book, 'genres' => $genres]);
    }
//Обновить книгу
    public function update(Request $request, $id)
    {
        $validator_ru = BookModerController::checkBookRu($request);
        $validator = BookModerController::checkBook($request);
        if ($validator->fails())
        {
            return redirect('/moder/edit/book/'.$id)
                ->withInput()
                ->withErrors($validator);
        }
        
        $data = Book::findOrFail($id);
        if($request->hasFile('avatar'))
        {
            $book_avatar = $request->file('avatar');
            $filename = time() .'.'. $book_avatar->getClientOriginalExtension();
             
			$img=Image::make($book_avatar);
			$img->resize(180, null, function ($constraint) {
            	$constraint->aspectRatio();
			});
			$img->save(public_path('uploads/book_avatar/'.$filename));
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
        $book = Book::findOrFail($id);
		DB::table('coments')->where('book_id', '=', $id)->delete();
		DB::table('ratings')->where('book_id', '=', $id)->delete();
		DB::table('links')->where('book_id', '=', $id)->delete();
		DB::table('recomends')->where('book_id', '=', $id)->delete();        
        Storage::delete('uploads/book_avatar/'.$book->avatar); 
		$book->delete();
        Logger::write(Logger::$book, $id, 'delete');
        return redirect('/moder/book'); 
    }
    
    public function checkBook(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'pubyear' => 'required|numeric|between:1900,2050',
            'genre_id' => 'required|numeric|max:255',
            'avatar' => 'image|mimes:jpeg,bmp,png',
        ]);
    }
    
    public function checkBookRu(Request $request)
    {
        return $validator_ru = $this->validate($request,
        [
            'title'=>'required|alpha_num_ru|max:255',
            'author' => 'required|alpha_ru|max:255',
            'type' => 'required|type_book|max:30',
            'description' => 'required|max:500',
        ]);
    }
    
}
