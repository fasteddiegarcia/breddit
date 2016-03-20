 <?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



if(env('APP_DEBUG')) {
   // Route to view logs. Only for use in development
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
   Route::auth();

   Route::get('/', function () {
       return view('welcome');
    });

   // This is where our app lives.
 Route::get('/home', 'HomeController@index');

 Route::group(['prefix' => 'api'], function() {

     Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);
     Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

     Route::group(['middleware' => 'auth'], function() {

         Route::resource('posts', 'PostsController', [
            'only' => ['store', 'update', 'destroy']
         ]);
     });
 });
});
