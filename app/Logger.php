<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;
use App\Log;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Logger extends Log
{
    public static $book = 1;
    public static $user = 2;
    
    static function write($obj_type = 0, $obj_id = 0, $action = "")
    {
        $logger = new self();
        $logger->user_id = Auth::user()->id;
        $logger->obj_id = intval($obj_id);
        $logger->obj_type = intval($obj_type);
        $logger->ip = Request::ip();
        $logger->time = date('Y-m-d H:i:s');
        $logger->action = trim($action);
        $logger->save();
    }
}
