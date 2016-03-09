<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Repositories\OrganizerRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventsController extends BaseController
{

    protected $resourcePrefix = 'events.events';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate($this->pagination);

        return $this->view('Index',
            compact('events')
            );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $organizers = $organizerRepositories->getOrganizersForSelectbox();

        return $this->view('Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Event::$rules);

        Event::create($request->all());

        return redirect()
            ->action('EventsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return $this->view('Show',
            compact('event')
        );
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = Event::findOrFail($id);


        return $this->view('Edit',
            compact('event')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $event = Event::findOrFail($id);
        $this->validate($request, Event::$rules);
        $event->update($request->all());

        return redirect()
            ->action('EventsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()
            ->action('EventsController@index');
    }
}
