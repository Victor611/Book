<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dep;
use App\User;
use Illuminate\Support\Facades\Validator;

class DepController extends Controller
{
    
    protected $layout = 'layouts.admin';
     
    public function __construct()
    {
        $this->middleware('auth');
    }
// Главная   
    public function index()
    {
        $deps = Dep::all();
        return view('moder_dep.index', ['deps' => $deps]);
    }
    
// Form Add New Dep   
    public function create()
    {
        $deps = Dep::all();
        return view('moder_dep.create', ['deps' => $deps]);
    }
// save new Dep
    public function save(Request $request)
    {
        
        $validator = DepController::checkCreate($request);        
        if ($validator->fails())
        {
            return redirect('/moder/create/dep')
                ->withInput()
                ->withErrors($validator);
        }
        
            $data = new Dep;
            $data->name = $request->name;
            $data->parent_id = $request->parent_id;
            $data->save();
            return redirect('/moder/dep');
        
    }
// Form Edit Dep    
    public function edit($id)
    {
        $dep = Dep::find($id);
        return view('moder_dep.edit',['dep' => $dep]);
        
    }
// Save Edit Dep
    public function update(Request $request, $id)
    {
        $validator = DepController::checkUpdate($request);
        if ($validator->fails())
        {
            return redirect('/moder/edit/dep/'.$id)
                ->withInput()
                ->withErrors($validator);
        }
        
            $data = Dep::find($id);
            $data->name = $request->name;
            $data->parent_id = $request->parent_id;
            $data->save();
            return redirect('/moder/dep');
    }
// Удалить книгу    
    public function delete($id)
    {
        $dep = Dep::find($id);
        $dep->delete();
        return redirect('/moder/dep'); 
    }
    
    public function checkCreate(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
        ]);        
    }
    
    public function checkUpdate(Request $request)
    {
        return  $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
            
        ]);        
    }
}