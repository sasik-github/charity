<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 11:52 PM
 */

namespace App\Http\Controllers;



use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends BaseController
{

    public function getIndex()
    {

        $about = About::getAbout();

        return view('about.aboutIndex',
            compact('about')
        );
    }

    public function getEdit()
    {

        $about = About::getAbout();

        return view('about.aboutEdit',
            compact('about')
        );
    }

    public function postEdit(Request $request)
    {

        $this->validate($request, About::$rules);

        $about = About::getAbout();

        $about->fill($request->all());
        $about->save();

        return redirect()
            ->action('AboutController@getEdit');
    }
}
