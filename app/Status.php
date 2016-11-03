<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;
use DB;

class Status extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['user_id', 'book_id', 'status', 'rating'];
    
    static function hasStatus($bid, $uid)
    {
       
        $status = DB::table('ratings')
                    ->where('user_id', '=', $uid)
                    ->where('book_id', '=', $bid)
                    ->get();
        foreach($status as $s)
        {
            if(!empty($s->status)) return $s->status;
        }
    }
    
    static function hasStatusId($bid, $uid)
    {
       
        $status = DB::table('ratings')
                    ->where('user_id', '=', $uid)
                    ->where('book_id', '=', $bid)
                    ->get();
        foreach($status as $s)
        {
            
            return $s->id;
        }
    }
    
    static function StatusToUser($uid, $sid)//выбирает книги которые прочел юзер принимает user_id & status_id
    {
        return DB::table('books')
                    ->select('books.id', 'avatar', 'title', 'author' )
                    ->join('ratings', 'books.id', '=', 'ratings.book_id')
                    ->where('ratings.user_id', '=', $uid)
                    ->where('ratings.status', '=', $sid)
                    ->paginate(5);
    }
    
    static function StatusToBook($bid, $sid)//выбирает юзеров которые читают книгу принимает book_id & status_id
    {
        return DB::table('users')
                    ->select('users.id', 'name', 'avatar')
                    ->join('ratings', 'users.id', '=', 'ratings.user_id')
                    ->where('ratings.book_id', '=', $bid)
                    ->where('ratings.status', '=', $sid)
                    ->paginate(5);
    }
    
    static function countStatusUser($uid, $sid)//считает количество прочитаных книг юзера принимает user_id & status_id
    {
        return DB::table('ratings')
                ->where('user_id', '=', $uid)
                ->where('status', '=', $sid)
                ->count();
    }
    
    static function countStatusBook($bid, $sid)//считает количество прочитаных юзеров которые прочли книгу принимает book_id & status_id
    {
        return DB::table('ratings')
                ->where('book_id', '=', $bid)
                ->where('status', '=', $sid)
                ->count();
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
