<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use DB;

class Link extends Model
{
    protected $table = 'links';
    protected $fillable = ['id', 'book_id', 'url', 'format'];
    public $timestamps =false;
    
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    static function countLink($id)
    {
        return DB::table('links')
                ->where('book_id', '=', $id)
                ->count();
    }
    
    static function BookToLink($bid)
    {
        return DB::table('links')
                    ->select('links.id', 'book_id', 'url', 'format')
                    ->join('books', 'books.id', '=', 'links.book_id')
                    ->where('links.book_id', '=', $bid)
                    ->get();
    }
}
