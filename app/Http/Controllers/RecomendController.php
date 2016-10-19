<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Recomend;

class RecomendController extends Controller
{
     public function save(Request $request)
    {
          if(!empty(Recomend::hasRecomend($request->book_id, $request->dep_id)) || !empty(Recomend::hasRecomend($request->book_id, -1)))
        {
            $id=Recomend::hasRecomendId($request->book_id, $request->dep_id);
            $data = Recomend::find($id);
            $data->status = $request->status;
            $data->dep_id = $request->dep_id;
            $data->save();
            return redirect('/book/'.$request->book_id);
        }                
            $data = new Recomend;
            $data->status = $request->status;
            $data->book_id = $request->book_id;
            $data->dep_id = $request->dep_id;
            $data->save();
            return redirect('/book/'.$request->book_id);
        
    }
}
