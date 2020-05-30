<?php

use Illuminate\Support\Facades\Route;

Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/', function (){
    return 'Hello!';
});
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'FolderController@create');
