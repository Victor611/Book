<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Link;
use App\Book;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
   protected $layout = 'layouts.moder';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
    
// Show Links    
    public function index($id)
    {
        $book = Book::findOrFail($id);
        return view('moder_link.index', ['book' => $book]);
    }

// Form Add New Link   
    public function create($id)
    {
        $book = Book::findOrFail($id);
        return view('moder_link.create', ['book' => $book]);
    }
    
// Save New Link
    public function save(Request $request)
    {
        
        $validator = LinkController::check($request);        
        if ($validator->fails())
        {
            return redirect('/moder/create/link/'.$request->book_id)
                ->withInput()
                ->withErrors($validator);
        }
        
        
            $data = new Link;
            $data->book_id = $request->book_id;
            $data->url = $request->url;
            $data->format = $request->format;
            $data->save();
            return redirect('/moder/book');
        
    }
// форма редактирования книги    
    public function edit($id)
    {
        $link = Link::find($id);
        return view('moder_link.edit',['link' => $link]);
        
    }
    
//Обновить книгу
    public function update(Request $request, $id)
    {
         $validator = LinkController::check($request);
         if ($validator->fails())
         {
            return redirect('/moder/edit/book/'.$id)
                ->withInput()
                ->withErrors($validator);
         }

         $data = Link::findOrFail($id);
         $data->book_id = $request->book_id;
         $data->url = $request->url;
         $data->format = $request->format;
         $data->save();
        return redirect('/moder/link/'.$data->book_id);
    }
// Удалить книгу    
    public function delete($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return redirect('/moder/book'); 
    }
    
    public function check(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'book_id' => 'required|numeric|max:255',
            'format' => 'required|max:500',
            'url' => 'required|url|max:255',
        ]);        
    }
}
