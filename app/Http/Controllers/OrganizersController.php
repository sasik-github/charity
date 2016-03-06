<?php
/**
 * User: sasik
 * Date: 3/6/16
 * Time: 5:52 PM
 */

namespace App\Http\Controllers;


use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizersController extends BaseController
{

    protected $resourcePrefix = 'organizers.organizers';

    public function index()
    {
        $organizers = Organizer::paginate($this->pagination);
        return $this->view('Index',
            compact('organizers')
            );
    }

    public function create()
    {
        return $this->view('Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, Organizer::$rules);

        $organizer = Organizer::create($request->all());

        return redirect()
            ->action('OrganizersController@index');
    }

    public function edit($id)
    {
        /**
         * @var $organizer Organizer
         */
        $organizer = Organizer::findOrFail($id);

        return $this->view('Edit',
            compact('organizer')
            );


    }

    public function update(Request $request, $id)
    {
        /**
         * @var $organizer Organizer
         */
        $organizer = Organizer::findOrFail($id);


        $this->validate($request, Organizer::$rules);
        $organizer->update($request->all());

        return redirect()
            ->action('OrganizersController@index');
    }
}
