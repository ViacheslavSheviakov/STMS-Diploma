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
Route::get('/user/data/edit', 'PagesController@getUserEdit')->name('user.edit');
Route::post('/user/data/edit/save', 'PagesController@getUserEditSave')->name('auth.edit');
Route::post('/user/data/password/save', 'PagesController@getUserPasswordSave')->name('auth.pswd.edit');
Route::get('/file/download/{report}', 'PagesController@getFile')->name('file.download');

// Admin
Route::get('/admin/mentor/attachment', 'AdminController@getMentorsAttachment')->name('admin.attachment');
Route::get('/admin/mentor/attachment/{mentor}', 'AdminController@getMentorsAttachmentAdd')->name('admin.attachment.change');
Route::post('/admin/mentor/attachment/store/{mentor}', 'AdminController@postMentorsAttachmentAdd')->name('admin.attachment.store');
Route::post('/admin/mentor/attachment/remove/{mentor}', 'AdminController@postMentorsAttachmentRemove')->name('admin.attachment.remove');

// Mentor
Route::get('/mentor/attach/{task}', 'MentorController@getAttachTask')->name('mentor.attach');
Route::post('/mentor/attach/hole_group', 'MentorController@postHoleCreate')->name('mentor.hole_create');
Route::post('/mentor/attach/hole_finish', 'MentorController@postHoleFinish')->name('mentor.hole_finish');
Route::post('/mentor/attach/one', 'MentorController@postOne')->name('mentor.one');
Route::post('/mentor/attach/one/student', 'MentorController@postOneStudent')->name('mentor.one_student');
Route::post('/mentor/attach/one/finish', 'MentorController@postOneFinish')->name('mentor.one_finish');
Route::get('/mentor/reports', 'MentorController@getReports')->name('mentor.reports');
Route::get('/mentor/reports/finished', 'MentorController@getFinished')->name('mentor.finished');
Route::get('/mentor/report/{id}', 'MentorController@getCheckReport')->name('report.check');
Route::get('/mentor/report/finished/{id}', 'MentorController@getCheckFinished')->name('report.finished');
Route::get('/mentor/report/apply/{id}/{status}', 'MentorController@getApplyStatus')->name('report.apply');

// Student
Route::post('/student/report', 'StudentController@postTask')->name('student.task_info');
Route::post('/student/report/save', 'StudentController@postReportSave')->name('student.report');

Route::put('users/{user}/restore', 'UserController@restore')->name('users.restore');
Route::resource('users', 'UserController');
Route::resource('groups', 'GroupController');
Route::resource('tasks', 'TaskController');