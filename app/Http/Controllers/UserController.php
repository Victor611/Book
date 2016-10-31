<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;
use Image;
use DB;
use App\Book;

class UserController extends Controller
{
    
    public function index()
    {
        $users = DB::table('users')
                     ->select(DB::raw('users.id, users.avatar, users.name, deps.name as deps, count(ratings.status) as status'))
                     ->join('deps', 'users.dep_id','=','deps.id')
                     
                     ->leftJoin('ratings','users.id','=','ratings.user_id')
                     ->where('ratings.status', '=', 3)
                     ->groupBy('users.id', 'users.avatar', 'users.name', 'deps.name')
                     ->orderBy('status', 'DESC')
                     ->get();
        return view('user.index', ['users' => $users]);
    }
    
    static function show($id)
    {
        $user = User::findOrFail($id);
        $coment = Book::join('coments', 'coments.book_id', '=', 'books.id')->where('user_id', '=', $id)->orderBy('coment', 'DESC')->limit(3)->get();
        return view('user.content', ['user' => $user, 'coment' => $coment]);
    }
}
