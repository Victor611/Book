<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;


class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = ['id', 'user_id', 'obj_id', 'obj_type', 'time', 'ip', 'action'];
    public $timestamps =false;
    
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }    
}
