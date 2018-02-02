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
Route::delete('/admin/user/delete/{id}', 'AdminController@delUser')->name('admin.user.delete');
Route::get('/admin/users/show', 'AdminController@showUsers')->name('admin.users.show');
Route::get('/admin/user/edit/{id}', 'AdminController@editUser')->name('admin.users.edit');
Route::get('/admin/user/pass/restore/{id}', 'AdminController@passRestore')->name('admin.user.pass.restore');
Route::post('/admin/user/update/{id}', 'AdminController@updateUser')->name('admin.user.update');

Route::get('/admin/groups/show', 'AdminController@showGroups')->name('admin.groups.show');
Route::get('/admin/group/new', 'AdminController@createGroup')->name('admin.group.new');
Route::post('/admin/group/save', 'AdminController@saveGroup')->name('admin.group.save');
Route::get('/admin/group/edit/{id}', 'AdminController@editGroup')->name('admin.group.edit');
Route::delete('/admin/group/delete/{id}', 'AdminController@delGroup')->name('admin.group.delete');
Route::post('/admin/group/update/{id}', 'AdminController@updateGroup')->name('admin.group.update');

// Student
Route::get('/home/student', 'StudentController@index')->name('home.student');

// Mentor
Route::get('/home/mentor', 'MentorController@index')->name('home.mentor');