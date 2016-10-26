<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Logger;

class UserAdminController extends Controller
{
    
    protected $layout = 'layouts.admin';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
// Главная   
    public function index()
    {
        $users = User::paginate(10);
        return view('admin_user.index', ['users' => $users]);
    }
// Удалить  
    public function delete($id)
    {
        
        $user = User::find($id);
        $user->coment()->delete();
        $user->rating()->delete();
        $user->delete();
        Logger::write(Logger::$user, $id, 'delete');
        return redirect('/admin/user'); 
    }    
}