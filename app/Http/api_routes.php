<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('activity_types', 'ActivityTypeAPIController');

Route::resource('regions', 'RegionAPIController');

Route::resource('provincias', 'ProvinciaAPIController');

Route::resource('comunas', 'ComunaAPIController');

Route::resource('iglesias', 'IglesiaAPIController');

Route::resource('personas', 'PersonaAPIController');

Route::resource('inscripcions', 'InscripcionAPIController');

Route::resource('user_types', 'UserTypeAPIController');

Route::resource('user_activity_templates', 'UserActivityTemplateAPIController');



Route::resource('user_activities', 'UserActivityAPIController');

Route::resource('activity_schedules', 'ActivityScheduleAPIController');

Route::resource('despositos', 'DespositoAPIController');



Route::resource('activities', 'ActivityAPIController');

Route::resource('personas', 'PersonaAPIController');