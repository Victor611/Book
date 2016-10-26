<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Status;
use App\Rating;
use App\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class StatusController extends Controller
{
    public function index(Request $request)
    {
        if(!empty(Status::hasStatus($request->book_id, $request->user_id)) || !empty(Rating::hasRating($request->book_id, $request->user_id)))
        {
            $status = StatusController::checkStatus($request);
            $id=Status::hasStatusId($request->book_id, $request->user_id);
            $data = Status::find($id);
            $data->status = $request->status;
            $data->save();
            return redirect('/book/'.$request->book_id);
        }    
            $status = StatusController::checkStatus($request);
            $data = new Status;
            $data->book_id = $request->book_id;
            $data->user_id = $request->user_id;
            $data->status = $request->status;
            $data->save();
            return redirect('/book/'.$request->book_id);
    }

    static function BookToUser($bid)
    {
        return $data = Status::find($bid);
    }
    
    public function checkStatus(Request $request)
    {
        return $status = $this->validate($request,
        [
            'status'=>'required|status',
            'user_id'=>'required|integer',
            'book_id'=>'required|integer',
            
        ]);
    }
}