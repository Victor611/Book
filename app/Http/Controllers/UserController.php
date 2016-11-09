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
        $users = User::orderBy('count_status3', 'DESC')->orderBy('count_coment', 'DESC')->paginate($this->paginator);
        //var_dump($users); exit;
        return view('user.index', ['users' => $users, 'paginator' => $this->paginator]);
    }
    
    static function show($id)
    {
        $user = User::findOrFail($id);
        $coment = Book::join('coments', 'coments.book_id', '=', 'books.id')->where('user_id', '=', $id)->orderBy('coments.updated_at', 'DESC')->limit(3)->get();
        return view('user.content', ['user' => $user, 'coment' => $coment]);
    }
    
    public function find(Request $request)
    {
        $part_name = Request::has('part') ? Request::get('part') : false;
        $lookLike = User::where('name', 'like', '%'.$part_name.'%')->get();
        $return = array();
        foreach($lookLike as $user)
            $return[$user->id] = $user->name;

        echo json_encode($return);
    }
    
    public function filter(Request $request)
    {
        $status = Request::has('status') ? Request::get('status') :false;
        //var_dump($status);exit;
        if($status){
            $users = User::leftJoin('ratings', 'users.id', '=', 'ratings.user_id')
            ->select('users.id', 'users.avatar', 'users.name', 'users.count_status2', 'count_status3', 'count_coment')
            ->where( function($query) use($status)
            {
                $method = ($status == 1) ? "whereIn" : "whereNotIn";
                $query->$method('users.id', function($q) 
                {
                    $q->select('user_id')->from('ratings')->where('status', "=", 2)->distinct();
                });
                $query->get();
            })
            ->groupBy('users.id')
            ->paginate($this->paginator);
            return view('user.index', ['users' => $users, 'paginator' => $this->paginator]);
        }
        else{ return $this->index(); }

        
    }
}