<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Active;
use App\Logger;


class ActiveController extends Controller
{
    protected $layout = 'layouts.admin';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
            $data = Active::findOrFail($request->user_id);
            $data->active = $request->active;
            $data->save();
            Logger::write(Logger::$user, $request->user_id, 'update active');
            return redirect('/admin/user');
    }
}
