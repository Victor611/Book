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
        $genres = Genre::orderBy('priority', 'ASC')->get();
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
        $this->update_priority();    
	return redirect('/moder/genre');
        
    }
// Form Edit Genre    
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('moder_genre.edit',['genre' => $genre]);
        
    }
// Save Edit Dep
    public function update(Request $request, $id)
    {
        $validator = GenreController::check($request);
        
            $data = Genre::findOrFail($id);
            $data->name = $request->name;
            $data->save();
            return redirect('/moder/genre');
    }
// Удалить книгу    
    public function delete($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
	$this->update_priority();        
	return redirect('/moder/genre'); 
    }
    
    public function check(Request $request)
    {
        return $validator_ru = $this->validate($request,
        [
            'name' => 'required|alpha_num_ru|max:255',
        ]);      
    }
    
    public function update_priority()
    {
    	$genres = Genre::orderBy('priority', 'ASC')->get();
	$i = 0;
	foreach($genres as $genre)
	{
	    $genre->priority = ++$i;
	    $genre->save();
	}
    }

    public function order($prior, $dec = null)
    {

        if(is_null($dec))
            $prior1 = $prior + 1;
        elseif($dec == 1)
            $prior1 = $prior - 1;

        $genre = Genre::where('priority', '=', $prior)->first();
        $genre1 = Genre::where('priority', '=', $prior1)->first();
        $genre->priority = $prior1;
        $genre->save();
        $genre1->priority = $prior;
        $genre1->save();
        //$this->update_priority();
        return redirect('/moder/genres');
    }
}
