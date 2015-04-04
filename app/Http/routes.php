<?php

Route::get('/', function()
{
	return View::make('index');
});

//API Routes
Route::group(array('prefix' => 'api'), function() {

	Route::resource('projects', 'ProjectsController');
    Route::resource('projects.repositories', 'RepositoriesController');
});