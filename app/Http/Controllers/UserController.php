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
        $users = User::orderBy('count_status','DESC')->paginate(10);
        return view('user.index', ['users' => $users]);
    }
    
    static function show($id)
    {
        $user = User::findOrFail($id);
        $coment = Book::join('coments', 'coments.book_id', '=', 'books.id')->where('user_id', '=', $id)->orderBy('coment', 'DESC')->limit(3)->get();
        return view('user.content', ['user' => $user, 'coment' => $coment]);
    }
}