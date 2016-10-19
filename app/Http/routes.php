<?php
use App\Task;
use App\User;
use App\Role;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/register', function(){return redirect('/');});

Route::group(['middleware' => 'auth'], function ()
{
	Route::get('/profile', 'ProfileController@profile');
	Route::post('/profile', 'ProfileController@update_avatar');
	
//	Route::get('/', 'RecomendController@index');
    
	Route::get('/', 'BookController@index');     
	Route::get('/book', 'BookController@index');
    Route::post('/book', 'BookController@filter');
	Route::get('/book/{id}', 'BookController@show');
	
    Route::get('/users', 'UserController@index');
	Route::post('/users', 'UserController@filter');
    Route::get('/user/{id}', 'UserController@show');
	
	Route::post('/coment', 'ComentController@save');
	Route::post('/coment/edit/{id}', 'ComentController@update');
	
	Route::post('/status', 'StatusController@index');
	Route::post('/rating', 'RatingController@index');
});

Route::group(['prefix' => 'moder', 'middleware' => ['auth', 'roles'], 'roles' => 'moderator'], function()
{
	Route::get('/book', ['uses' => 'BookModerController@index']);
	Route::get('/create/book', ['uses' => 'BookModerController@create']);
    Route::post('/save/book', ['uses' => 'BookModerController@save']);
    Route::get('/edit/book/{id}', ['uses' => 'BookModerController@edit']);
    Route::post('/update/book/{id}', ['uses' => 'BookModerController@update']);
    Route::get('/delete/book/{id}', 'BookModerController@delete');
        
    Route::get('/user', ['uses' => 'UserModerController@index']);
	Route::get('/create/user', ['uses' => 'UserModerController@create']);
    Route::post('/save/user', ['uses' => 'UserModerController@save']);
    Route::get('/edit/user/{id}', ['uses' => 'UserModerController@edit']);
    Route::post('/update/user/{id}', ['uses' => 'UserModerController@update']);
    Route::get('/delete/user/{id}', 'UserModerController@delete');
	
	Route::get('/dep',['uses' => 'DepController@index']);
	Route::get('/create/dep', ['uses' => 'DepController@create']);
	Route::post('/save/dep', ['uses' => 'DepController@save']);
	Route::get('/edit/dep/{id}', ['uses' => 'DepController@edit']);
    Route::post('/update/dep/{id}', ['uses' => 'DepController@update']);
    Route::get('/delete/dep/{id}', 'DepController@delete');
	
	Route::get('/link/{id}',['uses' => 'LinkController@index']);
	Route::get('/create/link/{id}', ['uses' => 'LinkController@create']);
	Route::post('/save/link', ['uses' => 'LinkController@save']);
	Route::get('/edit/link/{id}', ['uses' => 'LinkController@edit']);
    Route::post('/update/link/{id}', ['uses' => 'LinkController@update']);
    Route::get('/delete/link/{id}', 'LinkController@delete');
	
	//Route::get('/dep',['uses' => 'DepController@index']);
	//Route::get('/create/dep', ['uses' => 'DepController@create']);
	Route::post('/save/rec', ['uses' => 'RecomendController@save']);
	Route::get('/edit/dep/{id}', ['uses' => 'DepController@edit']);
    Route::post('/update/dep/{id}', ['uses' => 'DepController@update']);
    Route::get('/delete/dep/{id}', 'DepController@delete');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function()
{
	Route::get('/log', ['uses' => 'LogController@index']);
	Route::get('/delete/logs', ['uses' => 'LogController@delete']);
	
	Route::get('/user', ['uses' => 'UserAdminController@index']);
    Route::get('/delete/user/{id}', ['uses' => 'UserAdminController@delete']);
	
	Route::post('/active', ['uses' => 'ActiveController@index']);
});