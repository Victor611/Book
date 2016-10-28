<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Logger;
use DB;

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
        
        $user = User::findOrFail($id);
	DB::table('coments')->where('user_id', '=', $id)->delete();        
	DB::table('ratings')->where('user_id', '=', $id)->delete();
        $user->delete();
        Logger::write(Logger::$user, $id, 'delete');
        return redirect('/admin/user'); 
    }    
}
