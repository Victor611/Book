<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Coment;
use App\Dep;
use App\Rating;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'email', 'password', 'role_id', 'dep_id', 'active', 'count_coment', 'count_status3'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];
        
    public function hasRole($role = '')
    {
        if(empty($role)) return true;
        return ($this->role->name == trim(strtolower($role)));
       
    }
    
    
    public function rating()
    {
        return $this->hasMany('App\Rating');
    }
    
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    
    public function coment()
    {
        return $this->hasMany('App\Coment');
    }
    
    public function dep()
    {
        return $this->belongsTo('App\Dep');
    }
    
    
}