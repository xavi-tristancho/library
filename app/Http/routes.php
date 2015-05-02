<?php

Route::get('/', function()
{
	return View::make('index');
});

//API Routes
Route::group(array('prefix' => 'api'), function() 
{
	App::bind('League\Fractal\Serializer\SerializerAbstract', 'League\Fractal\Serializer\DataArraySerializer');

    Route::group(array('prefix' => 'statistics'), function()
    {
        Route::resource('projects', 'ProjectsStatisticsController');
    });

    Route::get('projects/{projectId}/bower', 'ProjectsController@bower');
	Route::resource('projects', 'ProjectsController');
    Route::resource('projects.repositories', 'RepositoriesController');
});