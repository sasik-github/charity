<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Modifications\DateModificationEvent;
use App\Models\Repositories\EventRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class EventsController extends BaseController
{

    protected $resourcePrefix = 'events.events';

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organizerId = $request->get('organizer');

        if ($organizerId) {
            $events = Event::where('organizer_id', $organizerId)->paginate($this->pagination);
        } else {
            $events = Event::paginate($this->pagination);
        }

        return $this->view('Index', [
                'events' => $events->appends(Input::except('page')),
                'organizerId' => $organizerId,
            ]);
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
     * @param  \Illuminate\Http\Request $request
     * @param EventRepository $eventRepository
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EventRepository $eventRepository)
    {
        $this->validate($request, Event::$rules);

        $eventRepository->create($request->all());

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

//        o $event->date;

        return $this->view('Edit',
            compact('event')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @param EventRepository $eventRepository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, EventRepository $eventRepository)
    {

//        dd($request->all());
        /**
         * @var $event Event
         */
        $event = Event::findOrFail($id);
        $this->validate($request, Event::$rules);
        $eventRepository->update($event, $request->all());

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
