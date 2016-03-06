<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Repositories\OrganizerRepositories;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventsController extends BaseController
{

    protected $resourcePrefix = 'events.events';

    /**
     * Display a listing of the resource.
     *
     * @param OrganizerRepositories $organizerRepositories
     * @return \Illuminate\Http\Response
     */
    public function index(OrganizerRepositories $organizerRepositories)
    {
        $events = Event::paginate($this->pagination);
        $organizers = $organizerRepositories->getOrganizersForSelectbox();

        return $this->view('Index',
            compact('events', 'organizers')
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param OrganizerRepositories $organizerRepositories
     * @return \Illuminate\Http\Response
     */
    public function create(OrganizerRepositories $organizerRepositories)
    {
        $organizers = $organizerRepositories->getOrganizersForSelectbox();

        return $this->view('Create',
            compact('organizers')
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $this->view('Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return $this->view('Edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
