<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Genre;
use App\Coment;
use App\Rating;
use App\Recomend;
use App\Link;
use DB;


class Book extends Model
{
    protected $table = 'books';
    
    protected $fillable = ['id', 'title', 'author' , 'description', 'pubyear', 'genre_id', 'type'];
     
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
    
    public function coment()
    {
        return $this->hasMany('App\Coment')->orderBy("id", "DESC");
    }
    
    public function rating()
    {
        return $this->hasMany('App\Rating');
    }
    
    public function link()
    {
        return $this->hasMany('App\Link');
    }
    
    public function recomend()
    {
        return $this->hasMany('App\Recomend');
    }
    
    static function countGenre($gid)//считает количество книг с данным жанром ($gid)
    {
        return DB::table('books')
                ->where('genre_id', '=', $gid)
                ->count();
    }
}
