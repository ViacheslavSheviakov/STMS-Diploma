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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin
Route::get('/home/admin', 'AdminController@index')->name('home.admin');
Route::get('/admin/user/new', 'AdminController@createUser')->name('admin.user.new');
Route::post('/admin/user/save', 'AdminController@saveUser')->name('admin.user.save');
Route::post('/admin/user/delete', 'AdminController@delUser')->name('admin.user.delete');
Route::get('/admin/users/change', 'AdminController@changeUsers')->name('admin.users.change');
Route::get('/admin/user/edit/{id}', 'AdminController@editUser')->name('admin.users.edit');

// Student
Route::get('/home/student', 'StudentController@index')->name('home.student');

// Mentor
Route::get('/home/mentor', 'MentorController@index')->name('home.mentor');