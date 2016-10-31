<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;
use DB;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['user_id', 'book_id', 'status', 'rating', 'created_at', 'updated_at'];
    
    static function hasRating($bid, $uid)
    {
       
        $rating = DB::table('ratings')
                    ->where('user_id', '=', $uid)
                    ->where('book_id', '=', $bid)
                    ->get();
        foreach($rating as $r)
        {
            if(!empty($r->rating)) return $r->rating;
        }
    }
    
    static function hasRatingId($bid, $uid)
    {
       
        $rating = DB::table('ratings')
                    ->where('user_id', '=', $uid)
                    ->where('book_id', '=', $bid)
                    ->get();
        foreach($rating as $r)
        {
            return $r->id;
        }
    }
    
    static function avgRating($id)
    {
        return DB::table('ratings')
                ->where('book_id', '=', $id)
                ->avg('rating');
    }
    
    static function countRating($id)
    {
        return DB::table('ratings')
                ->where('book_id', '=', $id)
                ->count('rating');
    }
    
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
