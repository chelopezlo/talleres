<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/home');
});


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});


Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/search', 'PersonaController@searchForm');

Route::get('/results', 'PersonaController@search');

Route::resource('activityTypes', 'ActivityTypeController');

Route::resource('regions', 'RegionController');

Route::resource('provincias', 'ProvinciaController');

Route::resource('comunas', 'ComunaController');

Route::resource('iglesias', 'IglesiaController');

Route::resource('personas', 'PersonaController');

Route::resource('inscripcions', 'InscripcionController');

Route::resource('userTypes', 'UserTypeController');

Route::resource('userActivityTemplates', 'UserActivityTemplateController');

Route::resource('userActivities', 'UserActivityController');

Route::resource('activitySchedules', 'ActivityScheduleController');

Route::resource('despositos', 'DespositoController');

Route::resource('activities', 'ActivityController');

Route::resource('personas', 'PersonaController');