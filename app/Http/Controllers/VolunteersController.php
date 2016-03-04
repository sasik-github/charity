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
    public function show(Volunteer $volunteer)
    {
        return $this->view('Show',
            compact('volunteer')
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Volunteer $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        return $this->view('Edit',
            compact('volunteer')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Volunteer $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
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
