<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Status;
use App\Rating;
use App\User;
use App\Book;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class StatusController extends Controller
{
    public function index(Request $request)
    {
        if(!empty(Status::hasStatus($request->book_id, $request->user_id)) || !empty(Rating::hasRating($request->book_id, $request->user_id)))
        {
			$status = StatusController::checkValidate($request);
			$id=Status::hasStatusId($request->book_id, $request->user_id);
			$data = Status::find($id);
			
			if(Status::hasStatus($request->book_id, $request->user_id) == (int)$request->status)
			{
				$data->delete();
			
				$user = User::findOrFail($request->user_id);
				$user->count_status2 = Status::countStatusUser($request->user_id, 2);
				$user->count_status3 = Status::countStatusUser($request->user_id, 3);
				$user->save();
				
				$book = Book::find($request->book_id);
				$book->avg_rating = Rating::avgRating($request->book_id);
				$book->count_status = Status::countStatusBook($request->book_id, 3);
				$book->save();
			
				return redirect('/book/'.$request->book_id);
			}
			
            $data->status = $request->status;
            $data->save();
            
			$user = User::findOrFail($request->user_id);
			$user->count_status2 = Status::countStatusUser($request->user_id, 2);
			$user->count_status3 = Status::countStatusUser($request->user_id, 3);
			$user->save();
			
			$book = Book::find($request->book_id);
			$book->avg_rating = Rating::avgRating($request->book_id);
			$book->count_status = Status::countStatusBook($request->book_id, 3);
			$book->save();
			
			
			return redirect('/book/'.$request->book_id);
        }    
            $status = StatusController::checkValidate($request);
			$data = new Status;
            $data->book_id = $request->book_id;
            $data->user_id = $request->user_id;
            $data->status = $request->status;
            $data->save();
			
			$user = User::findOrFail($request->user_id);
			$user->count_status2 = Status::countStatusUser($request->user_id, 2);
			$user->count_status3 = Status::countStatusUser($request->user_id, 3);
			$user->save();
			
			$book = Book::find($request->book_id);
			$book->avg_rating = Rating::avgRating($request->book_id);
			$book->count_status = Status::countStatusBook($request->book_id, 3);
			$book->save();
			
            return redirect('/book/'.$request->book_id);
    }

    static function BookToUser($bid)
    {
        return $data = Status::find($bid);
    }
    
    public function checkValidate(Request $request)
    {
        return $status = $this->validate($request,
        [
            'status'=>'required|status',
            'user_id'=>'required|integer',
            'book_id'=>'required|integer',
            
        ]);
    }
}
