<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Coment;
use App\Book;
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
        
        $data = new Coment;
        $data->coment = $request->coment;
        $data->user_id = $request->user_id;
        $data->book_id = $request->book_id;
        $data->save();
        
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
            return BookController::show($request->book_id);
        }
        else
        {
            
            $data->coment = $request->coment;
            $data->user_id = $request->user_id;
            $data->book_id = $request->book_id;
            $data->save(); 
        }
        
        
        return BookController::show($request->book_id);
    }
// Удалить книгу    
    //public function delete($id)
    //{
    //    $coment = Coment::find($id);
    //    $coment->delete();
    //    return redirect('/admin/coment'); 
    //}
    


    public function check(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
           'coment'=>'max:500',
        ]);        
    }
}
