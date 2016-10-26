<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Recomend;

class Dep extends Model
{
    protected $table = 'deps';
    protected $fillable = ['parent_id', 'name'];
    public $timestamps =false;
    
    public function user()
    {
        return $this->hasMany('App\User');
    }
    
    public function recomend()
    {
        return $this->hasMany('App\Recomend');
    }
}