<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;
use DB;

class Coment extends Model
{
    protected $table = 'coments';
    protected $fillable = ['user_id', 'book_id', 'coment', 'created_at', 'updated_at'];

    
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    static function countComent($uid)
    {
        return DB::table('coments')
                ->where('user_id', '=', $uid)
                ->count();
    }
}
