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
    Route::get('/', 'NewsesController@index');
//    Route::get('/home', 'HomeController@index');

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
    Route::get('newsesevents', 'API\NewsEventController@getNewsEvents');

    Route::post('user/register', 'API\VolunteersController@register');

    Route::post('files/upload', 'API\FileController@upload');

    Route::get('events/dates/{date}', 'API\EventsController@getDateInMonth');
    Route::get('events/by-date/{date}', 'API\EventsController@getEventsByDate');

    Route::group(['middleware' => ['api']], function() {


        Route::get('/auth/user-is-exist/{telephone}', 'API\AuthController@getUserIsExist');
        Route::post('/auth/reset-password/{telephone}', 'API\AuthController@postResetPassword');

        Route::get('authorize', 'API\VolunteersController@auth');

        Route::get('events', 'API\EventsController@getAllEvents');

        Route::get('events/my-events/', 'API\EventsController@getMyEvents');
        Route::get('events/my-administrated-events/', 'API\EventsController@getMyAdministratedEvents');

        Route::get('events/accepted-volunteers/{event}', 'API\EventsController@getAcceptedVolunteers');
        Route::get('events/is-accepted/{event}', 'API\EventsController@isAcceptedEvent');

        Route::post('events/accept/{event}', 'API\EventsController@acceptEvent');
        Route::post('events/reject/{event}', 'API\EventsController@rejectEvent');

        Route::post('events/grant/{event}', 'API\EventsController@grantPointsToVolunteers');

        Route::get('organizers', 'API\OrganizersController@getAllOrganizers');

        Route::post('user/update', 'API\VolunteersController@update');

        Route::post('token', 'API\TokensController@store');
    });
});
