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

Auth::routes();
Route::redirect('/', '/home');
Route::redirect('/register', '/login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cars', 'CarController@index');
    Route::get('/cars/add', 'CarController@add');
    Route::get('/cars/{car}', 'CarController@show');
    Route::get('/parts', 'PartController@index');
});

Route::post('cars/add/image/upload', 'ImageController@upload')->name('image.upload');
Route::post('cars/add', 'CarController@add_new_car')->name('cars.add');


Route::get('/home', 'HomeController@index')->name('home');