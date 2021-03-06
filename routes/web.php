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

Route::get('/', function () {
    return view('welcome');
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::resource('/task_statuses', 'TaskStatusController');

Route::resource('/tasks', 'TaskController');

Route::resource('/labels', 'LabelController');
