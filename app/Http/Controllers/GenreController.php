<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
     protected $layout = 'layouts.admin';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
// Главная   
    public function index()
    {
        $genres = Genre::all();
        return view('moder_genre.index', ['genres' => $genres]);
    }
    
// Form Add New Genre   
    public function create()
    {
        $genres = Genre::all();
        return view('moder_genre.create', ['genres' => $genres]);
    }
// save new Genre
    public function save(Request $request)
    {
        
        $validator = GenreController::check($request);        
        
            $data = new Genre;
            $data->name = $request->name;
            $data->save();
            return redirect('/moder/genre');
        
    }
// Form Edit Genre    
    public function edit($id)
    {
        $genre = Genre::find($id);
        return view('moder_genre.edit',['genre' => $genre]);
        
    }
// Save Edit Dep
    public function update(Request $request, $id)
    {
        $validator = GenreController::check($request);
        
            $data = Genre::find($id);
            $data->name = $request->name;
            $data->save();
            return redirect('/moder/genre');
    }
// Удалить книгу    
    public function delete($id)
    {
        $genre = Genre::find($id);
        $genre->delete();
        return redirect('/moder/genre'); 
    }
    
    public function check(Request $request)
    {
        return $validator_ru = $this->validate($request,
        [
            'name' => 'required|alpha_num_ru|max:255',
        ]);      
    }
    
}
