<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::resource('/news', 'NewsesController');
    Route::resource('/events', 'EventsController');
    Route::resource('/volunteers', 'VolunteersController');
    Route::resource('/organizers', 'OrganizersController');

    Route::get('/about', 'AboutController@getIndex');
    Route::get('/about/edit', 'AboutController@getEdit');
    Route::post('/about/edit', 'AboutController@postEdit');

});


Route::group(['prefix' => 'api/'], function() {

    Route::get('newses', 'API\NewsesController@getNewses');

    Route::post('user/register', 'API\VolunteersController@register');

    Route::post('files/upload', 'API\FileController@upload');


    Route::group(['middleware' => ['api']], function() {
        Route::get('authorize', 'API\VolunteersController@auth');

        Route::get('events', 'API\EventsController@getAllEvents');
        Route::get('events/by-date/{date}', 'API\EventsController@getEventsByDate');
        Route::get('events/dates/{date}', 'API\EventsController@getDateInMonth');
        Route::get('events/my-events/', 'API\EventsController@getMyEvents');
        Route::get('events/accept/{event}', 'API\EventsController@acceptEvent');

        Route::get('organizers', 'API\OrganizersController@getAllOrganizers');

        Route::post('user/update', 'API\VolunteersController@update');
    });
});
