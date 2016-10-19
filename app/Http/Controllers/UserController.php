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
        $users = User::paginate(3);
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
        $order_by = Request::has('order_by') ? Request::get('order_by'): false;    // столбец сортировки
         
        $column = '';       
        if($sort) $param = $sort;
        if($order_by) $column = $order_by;
        
        $where = [];
        
        $users = User::where($where)->orderBy($column, $param)->get();
        //dd($users);
        return view('user.index', ['users' => $users]);
    }
}
