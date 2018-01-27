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

// Student
Route::get('/home/student', 'StudentController@index')->name('home.student');

// Mentor
Route::get('/home/mentor', 'MentorController@index')->name('home.mentor');