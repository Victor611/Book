<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Coment;
use App\Book;
use App\User;
use App\Http\Controllers\BookController;

class ComentController extends Controller
{    
    public function save(Request $request)
    {
        
        $validator = ComentController::check($request);        
        
		if ($validator->fails())
        {
            return redirect('/book/'.$request->book_id)
                ->withInput()
                ->withErrors($validator);
        }
       
		if(empty($request->coment))
		{
			return redirect('/book/'.$request->book_id);
		}
		
		$data = new Coment;
        $data->coment = $request->coment;
        $data->user_id = $request->user_id;
        $data->book_id = $request->book_id;
        $data->save();
		
		$user = User::findOrFail($request->user_id);
		$user->count_coment = Coment::countComentUser($request->user_id);
		$user->save();
		
		$book = Book::find($request->book_id);
		$book->count_coment = Coment::countComentBook($request->book_id);
		$book->save();
        
        return redirect('/book/'.$data->book_id); 
        
    }
    
    public function update(Request $request, $id)
    {
        $validator = ComentController::check($request);
        if ($validator->fails())
        {
            return redirect('/book/'.$request->book_id)
                ->withInput()
                ->withErrors($validator);
        }
        
        $data = Coment::find($id);
       
        if (empty($request->coment))
        {
			$data->delete();
			
			$user = User::findOrFail($request->user_id);
			$user->count_coment = Coment::countComentUser($request->user_id);
			$user->save();
			
			$book = Book::find($request->book_id);
			$book->count_coment = Coment::countComentBook($request->book_id);
			$book->save();
            return redirect('/book/'.$request->book_id);
        }
        else
        {
            $data->coment = $request->coment;
            $data->user_id = $request->user_id;
            $data->book_id = $request->book_id;
            $data->save();
			
			$user = User::findOrFail($request->user_id);
			$user->count_coment = Coment::countComentUser($request->user_id);
			$user->save();
			
			$book = Book::find($request->book_id);
			$book->count_coment = Coment::countComentBook($request->book_id);
			$book->save();
        }
        
        
        return redirect('/book/'.$request->book_id);
    }

    public function check(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
           'coment'=>'max:500',
        ]);        
    }
}
