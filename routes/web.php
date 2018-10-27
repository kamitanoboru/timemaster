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

Route::get('/', 'WelcomeController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//サービスの説明、使い方
Route::view('/intro', 'intro');

//　ログイン認証付きのルーティング
Route::group(['middleware' => ['auth']], function () {

    //タスクの登録、変更、削除など
    //タスクの明日以降の未完了の表示
    //Route::resource('tasks', 'TasksController', ['only' => ['index','show', 'create', 'store' ,'update','edit','destroy','future','memoshow','memoedit','print']]);




//タスクの新規追加
Route::get('tasks/create', 'TasksController@create')->name('tasks.create');
Route::post('tasks/store', 'TasksController@store')->name('tasks.store');

//今後のタスクの一覧
Route::get('tasks/future', 'TasksController@future')->name('tasks.future');

//今後のタスクの一覧
Route::get('tasks/all', 'TasksController@all')->name('tasks.all');

//マイタイムの表示

Route::get('mytime', 'TasksController@mytime_get')->name('tasks.mytime_get');

Route::post('mytime', 'TasksController@mytime_post')->name('tasks.mytime_post');

//マイタイムtomorrowの表示

Route::get('mytime_tm', 'TasksController@mytime_tm_get')->name('tasks.mytime_tm_get');

Route::post('mytime_tm', 'TasksController@mytime_tm_post')->name('tasks.mytime_tm_post');

//開始日をずらすchangedate
Route::get('changedate/{task_id}/{plus}', 'TasksController@changedate')->name('tasks.changedate')->where(['task_id' => '[0-9]+', 'plus' => '[0-9]+']);;


//印刷用ページ
Route::get('mytime/{print}', 'TasksController@mytime_get')->name('tasks.mytime_get_print');

//タスクの編集
Route::get('tasks/{id}/edit', 'TasksController@edit')->name('tasks.edit');
//タスクの編集
Route::post('tasks/update', 'TasksController@update')->name('tasks.update');

//タスクのメモの表示
Route::get('tasks/{id}/memo_view', 'TasksController@memo_view')->name('tasks.memo_view');

//タスクのメモの編集
Route::post('tasks/update_memo', 'TasksController@update_memo')->name('tasks.update_memo');

//タスクの削除
Route::get('tasks/{id}/destroy', 'TasksController@destroy_before')->name('tasks.destroy_before');
Route::post('tasks/destroy', 'TasksController@destroy')->name('tasks.destroy');

//googleカレンダーの表示
Route::get('/gc', 'UsersController@gc')->name('users.gc');

//マイメモの表示
Route::get('/mymemo', 'UsersController@mymemo')->name('users.mymemo');



    //ユーザー情報の変更と削除
    //Route::resource('users', 'UsersController', ['only' => ['update','edit','destroy']]);
    Route::get('users/edit', 'UsersController@edit')->name('users.edit');
    Route::post('users/update', 'UsersController@update')->name('users.update');
    Route::post('users/destroy', 'UsersController@destroy')->name('users.destroy');    
    // マイタイムの表示
    //Route::resource('/mytime', 'UsersController', ['only' => ['index']]);


});