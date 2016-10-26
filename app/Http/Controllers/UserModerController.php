<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Dep;
use App\Logger;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class UserModerController extends Controller
{
    
    protected $layout = 'layouts.moder';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
// Главная   
    public function index()
    {
        $users = User::paginate(10);
        return view('moder_user.index', ['users' => $users]);
    }
    
// Форма Add new book   
    public function create()
    {
        $deps = Dep::all();
        $roles = Role::all();
        return view('moder_user.create', ['roles' => $roles, 'deps' => $deps]);
    }
// save new book
    public function save(Request $request)
    {
        $validator_ru = UserModerController::checkUserRu($request);
        $validator = UserModerController::checkCreate($request);        
        if ($validator->fails())
        {
            return redirect('/moder/create/user')
                ->withInput()
                ->withErrors($validator);
        }
        
            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->role_id = $request->role_id;
            $data->dep_id = $request->dep_id;
            $data->save();
            Logger::write(Logger::$user, $data->id, 'create');
            return redirect('/moder/user');
        
    }
// форма редактирования книги    
    public function edit($id)
    {
        $deps = Dep::all();
        $roles = Role::all();
        $user = User::find($id);
        return view('moder_user.edit',['user' => $user, 'roles' => $roles, 'deps' => $deps]);
        
    }
//Обновить книгу
    public function update(Request $request, $id)
    {
        $validator_ru = UserModerController::checkUserRu($request);
        $validator = UserModerController::checkUpdate($request);
        if ($validator->fails())
        {
            return redirect('/moder/edit/user/'.$id)
                ->withInput()
                ->withErrors($validator);
        }

        $data = User::find($id);
        $data->name = $request->name;
        if($data->email != $request->email)
            $data->email = $request->email;
        $data->role_id = $request->role_id;
        $data->dep_id = $request->dep_id;
        $data->save();
        Logger::write(Logger::$user, $data->id, 'update');
        return redirect('/moder/user');
    }
// Удалить книгу    
    public function delete($id)
    {
        
        $user = User::find($id);
        $user->coment()->delete();
        $user->rating()->delete();
        $user->delete();
        Logger::write(Logger::$user, $id, 'delete');
        return redirect('/moder/user'); 
    }
    
    public function checkCreate(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role_id' => 'required|numeric',
        ]);        
    }
    
    public function checkUpdate(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
            'role_id' => 'required',
        ]);        
    }
    
    public function checkUserRu(Request $request)
    {
        return $validator_ru = $this->validate($request,
        [
            'name'=>'alpha_num_ru',
        ]);
    }
}