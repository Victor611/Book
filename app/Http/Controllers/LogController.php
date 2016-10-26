<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Log;
use DB;

class LogController extends Controller
{
    protected $layout = 'layouts.admin';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $logs = DB::table('logs')->orderBy('time', 'desc')->take(1000)->paginate(20);
        return view('admin_log.index', ['logs' => $logs]);
    }

}
