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
    public $paginator = 10;
    public function index()
    {
        $users = User::orderBy('count_status', 'DESC')->orderBy('count_coment', 'DESC')->paginate($this->paginator);
        //var_dump($users); exit;
        return view('user.index', ['users' => $users, 'paginator' => $this->paginator]);
    }
    
    static function show($id)
    {
        $user = User::findOrFail($id);
        $coment = Book::join('coments', 'coments.book_id', '=', 'books.id')->where('user_id', '=', $id)->orderBy('coments.updated_at', 'DESC')->limit(3)->get();
        return view('user.content', ['user' => $user, 'coment' => $coment]);
    }
    
    public function filter(Request $request)
    {
        $part_name = Request::has('part') ? Request::get('part') : false;
        $lookLike = User::where('name', 'like', '%'.$part_name.'%')->get();
        $return = array();
        foreach($lookLike as $user)
            $return[$user->id] = $user->name;

        echo json_encode($return);
    }
}