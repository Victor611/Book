<?php

namespace App\Http\Controllers;

use App\Recomend;
use App\Http\Requests;
use DB;
use Request;

class RecomendController extends Controller
{
     public function save(Request $request)
    {
          $deps = Request::has('deps') ? Request::get('deps') : [];
          $book_id = Request::has('book_id') ? Request::get('book_id') : false;
          $status = Request::has('status') ? Request::get('status') : false;
          DB::table('recomends')->where('recomends.book_id', '=', $book_id)->delete();
          
          $insert = [
               'book_id' => $book_id,
               'status' => $status,
               'dep_id' => 0,
          ];
          
          if(count($deps) > 0 && in_array('-1', $deps))
          {
               $insert['dep_id'] = -1;
               DB::table('recomends')->insert($insert);
          }
          elseif(count($deps) > 0)
          {
               foreach($deps as $dep_id)
               {
                   $insert['dep_id'] = $dep_id;
                   DB::table('recomends')->insert($insert);
               }
          }
          
          return redirect('/book/'.$book_id);
     }
    
    public function checkCreate(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'status' => 'required|numeric',
            'book_id' => 'required|numeric',
            'dep_id' => 'required|numeric',
        ]);        
    }
}
