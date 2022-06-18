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

Route::get('/bsb', function () {
    return view('adminbsb/welcome_adminbsb');
});

Route::get('/slicks', function () {
    return view('slick/index');
});


Route::get('rptpesanrekap/detail', 'rptpesanrekapController@getdetailpesan');

$stmemenu = stmemenu::where('links','<>','')->get();
foreach($stmemenu as $menu){
    Route::resource($menu->links, $menu->controllername);	
}



Auth::routes(['verify' => true]);

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::resource('grctrl', 'globreportController');

Route::resource('databrowser', 'databrowserController');

Route::get('coba', function(){return view('coba');});
Route::resource('editprofile', 'userseditprofileController');
Route::resource('mstmerk', 'mstmerkController');
Route::resource('mstjenis', 'mstjenisController');

Route::resource('estkirimmemo', 'rptpesanestkirimmemoController');

Route::resource('cartsp', 'trpesancartController');
