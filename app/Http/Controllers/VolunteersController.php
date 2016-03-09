<?php

namespace App\Http\Controllers;

use App\Models\Repositories\VolunteerRepository;
use App\Models\Volunteer;
use Illuminate\Http\Request;

use App\Http\Requests;

class VolunteersController extends BaseController
{

    protected $resourcePrefix = 'volunteers.volunteers';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volunteers = Volunteer::paginate($this->pagination);

        return $this->view('Index',
            compact('volunteers')
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param VolunteerRepository $volunteerRepository
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, VolunteerRepository $volunteerRepository)
    {
        $this->validate($request, $volunteerRepository->getValidationRules());
        $volunteer = $volunteerRepository->create($request->all());

        return redirect()
            ->action('VolunteersController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Volunteer $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * @var $volunteer Volunteer
         */
        $volunteer = Volunteer::findOrFail($id);

        $events = $volunteer->events;

        return $this->view('Show',
            compact('volunteer', 'events')
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VolunteerRepository $volunteerRepository
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Volunteer $volunteer
     */
    public function edit(VolunteerRepository $volunteerRepository, $id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteerRepository->prepareToEditForm($volunteer);

        return $this->view('Edit',
            compact('volunteer')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @param VolunteerRepository $volunteerRepository
     * @return \Illuminate\Http\Response
     * @internal param Volunteer $volunteer
     */
    public function update(Request $request, $id, VolunteerRepository $volunteerRepository)
    {

        $volunteer = Volunteer::findOrFail($id);

        $this->validate($request, $volunteerRepository->getValidationRules($volunteer->user->id));

        $volunteerRepository->update($volunteer, $request->all());

        return redirect()
            ->action('VolunteersController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Volunteer $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        //
    }
}
