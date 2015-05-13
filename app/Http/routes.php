<?php

Route::get('/', function()
{
	return View::make('index');
});

//API Routes
Route::group(array('prefix' => 'api'), function() 
{
	App::bind('League\Fractal\Serializer\SerializerAbstract', 'League\Fractal\Serializer\DataArraySerializer');

    Route::post('register', 'SessionsController@register');
    Route::post('login', 'SessionsController@login');

    Route::get('users/me', 'UsersController@me');
    Route::resource('users', 'UsersController');

    Route::group(array('prefix' => 'statistics'), function()
    {
        Route::resource('projects', 'ProjectsStatisticsController');
    });

    Route::get('projects/{projectId}/bower', 'ProjectsController@bower');
	Route::resource('projects', 'ProjectsController');
    Route::resource('projects.repositories', 'RepositoriesController');
    Route::resource('projects.links', 'LinksController');

    Route::resource('managers', 'ManagersController');
});