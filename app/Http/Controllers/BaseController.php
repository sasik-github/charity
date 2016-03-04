<?php
/**
 * User: sasik
 * Date: 3/3/16
 * Time: 11:21 AM
 */

namespace App\Http\Controllers;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as LaravelController;

class BaseController extends LaravelController
{

    /**
     * @var string префикс который используется в view('[home.home]Index')
     */
    protected $resourcePrefix = 'home.home';

    use ValidatesRequests;

    /**
     * количество элементе на странице
     * @var int
     */
    protected $pagination = 5;

    /**
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view = null, $data = [], $mergeData = [])
    {
        return view($this->resourcePrefix . $view, $data, $mergeData);
    }
}