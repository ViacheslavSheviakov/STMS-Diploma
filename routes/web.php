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

// Personal Pages
Route::get('/home/admin', 'PagesController@getAdminIndex')->name('home.admin');
Route::get('/home/mentor', 'PagesController@getMentorIndex')->name('home.mentor');
Route::get('/home/student', 'PagesController@getStudentIndex')->name('home.student');

// Admin
Route::get('/admin/mentor/attachment', 'AdminController@getMentorsAttachment')->name('admin.attachment');
Route::get('/admin/mentor/attachment/{mentor}', 'AdminController@getMentorsAttachmentAdd')->name('admin.attachment.change');
Route::post('/admin/mentor/attachment/store/{mentor}', 'AdminController@postMentorsAttachmentAdd')->name('admin.attachment.store');
Route::post('/admin/mentor/attachment/rmove/{mentor}', 'AdminController@postMentorsAttachmentRemove')->name('admin.attachment.remove');

Route::put('users/{user}/restore', 'UserController@restore')->name('users.restore');
Route::resource('users', 'UserController');
Route::resource('groups', 'GroupController');
Route::resource('tasks', 'TaskController');