<?php
use App\stmemenu;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $title = '';
//     return view('welcome', compact('title'));
// });

Route::get('/adminlte3_starter', function () {
    return view('adminlte3/welcome_adminlte3');
});


Route::get('/xxx', function () {
    return view('adminlte3/index');
});

Route::get('/adminbsb', function () {
    return view('adminbsb/welcome_adminbsb');
});

Route::get('/slicks', function () {
    return view('slick/index');
});


$stmemenu = stmemenu::where('links','<>','')->get();

foreach($stmemenu as $menu){
    Route::resource($menu->links, $menu->controllername);	
}

Route::get('rptpesanrekap_detail', 'rptpesanrekapController@getdetailpesan');


Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::resource('gr', 'globreportController');
