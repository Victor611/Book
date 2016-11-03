<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Rating;
use App\Book;
use App\Status;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        if(!empty(Rating::hasRating($request->book_id, $request->user_id)) || !empty(Status::hasStatus($request->book_id, $request->user_id)))
        {
            $rating = RatingController::checkRating($request);
            $id=Rating::hasRatingId($request->book_id, $request->user_id);
            $data = Rating::find($id);
            $data->book_id = $request->book_id;
            $data->user_id = $request->user_id;
            $data->rating = $request->rating;
            $data->save();
            
            $book = Book::find($request->book_id);
            $book->avg_rating = Rating::avgRating($book->id);
            $book->save();
            return redirect('/book/'.$request->book_id);
        }    
            $rating = RatingController::checkRating($request);
            $data = new Rating;
            $data->book_id = $request->book_id;
            $data->user_id = $request->user_id;
            $data->rating = $request->rating;
            $data->save();
            
            $book = Book::find($request->book_id);
            $book->avg_rating = Rating::avgRating($book->id);
            $book->save();
            return redirect('/book/'.$request->book_id);
    }
    
    public function checkRating(Request $request)
    {
        return $validator_ru = $this->validate($request,
        [
            'rating'=>'required|rating|max:255',
        ]);
    }
}