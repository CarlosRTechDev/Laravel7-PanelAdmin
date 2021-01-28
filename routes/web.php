<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//para usar los metodos del controller; esto es mas eficaz
Route::resource('usuarios', 'UserController');
Route::resource('roles', 'RoleController');

//Rutas de las Notas
Route::resource('/notas/todas', 'NotasController');
Route::get('/notas/favoritas', 'NotasController@favoritas');
Route::get('/notas/archivadas', 'NotasController@archivadas');