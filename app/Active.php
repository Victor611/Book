<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Active extends Model
{
    protected $table = 'users';
    protected $fillable = ['id','active'];
    
    static function hasActive( $uid)
    {
       
        $active = DB::table('users')
                    ->select('id','active')
                    ->where('id', '=', $uid)
                    ->get();
        foreach($active as $a)
        {
            if(!empty($a->active)) return $a->active;
        }
    }
}
