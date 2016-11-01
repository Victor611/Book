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
				if((int)$request->status == 3)
				{
					$user = User::find($request->user_id);
					$user->count_status = 0;
					$user->save();
					
					$book = Book::find($request->book_id);
					$book->count_status = 0;
					$book->save();
				}
				$data->delete();
				return redirect('/book/'.$request->book_id);
			}
			
			$user = User::find($request->user_id);
			$book = Book::find($request->book_id);
			//var_dump($user->status);exit;
			if((int)$data->status == 3 && (int)$request->status !== 3)
			{
				$user->count_status = $user->count_status-1;
				$user->save();
				
				$book->count_status = $book->count_status-1;
				$book->save();
			}
			elseif((int)$data->status !== 3 && (int)$request->status == 3)
			{
				$user->count_status = $user->count_status+1;
				$user->save();
				
				$book->count_status = $book->count_status+1;
				$book->save();
			}
            $data->status = $request->status;
            $data->save();
            return redirect('/book/'.$request->book_id);
        }    
            $status = StatusController::checkValidate($request);
            
			if((int)$request->status == 3)
			{
				$user = User::find($request->user_id);
				$user->count_status = $user->count_status+1;
				$user->save();
				
				$book = Book::find($request->book_id);
				$book->count_status = $book->count_status+1;
				$book->save();
			}
			
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
