<?php

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

// Route::get('/cars', function () {
//     $cars = App\Car::all();
//     return 
// });

Auth::routes(['register' => false]);
Route::redirect('/', '/home');
// Route::redirect('/register', '/login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cars', 'CarController@index');
    Route::get('/cars/disassembling', 'CarController@index_disassembling');
    Route::get('/cars/disassembled', 'CarController@index_disassembled');
    Route::get('/cars/add', 'CarController@add');
    Route::get('/cars/{car}', 'CarController@show');
    Route::get('/parts', 'PartController@index');
    Route::get('/parts/storage', 'PartController@index_storage');
    Route::get('/parts/sold', 'PartController@index_sold');
    Route::get('/parts/add/{car?}', 'PartController@add');
    Route::get('/parts/add_type', 'PartController@add_type');
    Route::get('/parts/{part}/main', 'PartController@show');
    Route::get('/parts/{part}/prise_check', 'PartController@prise_check');
});

Route::get('/search_by_barcode', function () {
    return view('search.search_by_barcode');
});

Route::post('/image_uploaded', 'ImageController@upload')->name('image.upload');

Route::post('/cars/add', 'CarController@add_new_car')->name('cars.add');
Route::post('cars/save_changes', 'CarController@save_changes')->name('cars.save_changes');
Route::post('cars/delete_part', 'CarController@delete_car')->name('cars.delete_car');
Route::post('/cars', 'CarController@index_with_search_query')->name('cars.search');

Route::post('/parts/add', 'PartController@add_new_part')->name('parts.add');
Route::post('parts/save_changes', 'PartController@save_changes')->name('parts.save_changes');
Route::post('parts/delete_part', 'PartController@delete_part')->name('parts.delete_part');
Route::post('/part', 'PartController@index_with_search_query')->name('parts.search');


Route::delete('/cars/{car}', function (\App\Car $car) {
    $car->delete();
    return redirect('/cars');
});

Route::get('/home', 'HomeController@index')->name('home');
