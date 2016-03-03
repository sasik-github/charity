<?php
/**
 * User: sasik
 * Date: 3/3/16
 * Time: 11:16 AM
 */

namespace App\Http\Controllers;


use App\Models\News;
use Illuminate\Http\Request;

class NewsesController extends BaseController
{
    public function index()
    {
        $newses = News::all();

        return view('newses.newsesIndex');
    }

    public function show(News $news)
    {
        return view('newses.newsesShow',
                compact('news')
            );
    }

    public function create()
    {
        return view('newses.newsesNew');
    }

    public function store(Request $request)
    {

        $this->validate($request, News::$rules);

        News::create($request->all());

        return redirect()
            ->action('NewsesController@index');
    }

    public function edit(News $news)
    {
        return view('newses.newsesEdit',
                compact('news')
        );
    }

    public function update(News $news, Request $request)
    {
        $this->validate($request, News::$rules);

        $news->update($request->all());

        return redirect()
            ->action('NewsesController@index');
    }



    public function destroy(News $news)
    {
        $news->delete();
        return redirect()
            ->action('NewsesController@index');
    }


}