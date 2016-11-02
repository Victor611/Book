<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dep;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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
        $deps = Dep::with('children')->paginate(10);
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
        
        $validator = DepController::checkDep($request);        
                
            $data = new Dep;
            $data->name = $request->name;
            $data->parent_id = $request->parent_id;
            $data->save();
            return redirect('/moder/dep');
        
    }
// Form Edit Dep    
    public function edit($id)
    {
        $deps = Dep::where('parent_id', '0')->get();
		$dep = Dep::find($id);
		//var_dump($deps); exit;
        return view('moder_dep.edit',['dep' => $dep, 'deps' => $deps]);
        
    }
// Save Edit Dep
    public function update(Request $request, $id)
    {
        $validator = DepController::checkDep($request);
        
            $data = Dep::find($id);
            $data->name = $request->name;
            $data->parent_id = $request->parent_id;
            $data->save();
            return redirect('/moder/dep');
    }
// Удалить книгу    
    public function delete($id)
    {
        $dep = Dep::findOrFail($id);
        $dep->delete();
        return redirect('/moder/dep'); 
    }
    
    public function checkDep(Request $request)
    {
        return $validator_ru = $this->validate($request,
        [
            'name' => 'required|alpha_num_ru|max:255',
        ]);
    }
}
