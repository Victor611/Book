<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dep;
use App\Book;
use DB;

class Recomend extends Model
{
    protected $table = 'recomends';
    protected $fillable = ['dep_id', 'user_id', 'status'];
    public $timestamps =false;
    
    static function hasRecomend($bid, $did)
    {
       
        $recomend = DB::table('recomends')
                    ->where('dep_id', '=', $did)
                    ->where('book_id', '=', $bid)
                    ->get();
        foreach($recomend as $rec)
        {
            if(!empty($rec->status)) return $rec->dep_id;
        }
    }
    
    static function hasRecomendId($bid, $did)
    {
       
        $recomend = DB::table('recomends')
                    ->where('dep_id', '=', $did)
                    ->where('book_id', '=', $bid)
                    ->get();
        foreach($recomend as $rec)
        {
            
            return $rec->id;
        }
    }
    
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    public function dep()
    {
        return $this->belongsTo('App\Dep');
    }
    
    //static function countComent($uid)
    //{
    //    return DB::table('coments')
    //            ->where('user_id', '=', $uid)
    //            ->count();
    //}
}
