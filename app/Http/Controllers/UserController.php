<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', ['users' => $users]);
    }
    
    static function show($id)
    {
        $user = User::find($id);
        return view('user.content', ['user' => $user]);
    }
    
    public function filter(Request $request)
    {
        $sort = Request::has('sort') ? Request::get('sort') : false; // Параметр сортировки 'ASC','DESC'
        
        $column = "id";
        $order = null;
        if($sort)
        {
            list($column, $order) = explode("::", $sort);
        }    
         
        $where = [];
        
        $users = User::where($where)->orderBy($column, $order)->paginate(10);
        
        return view('user.index', ['users' => $users]);
    }
}
