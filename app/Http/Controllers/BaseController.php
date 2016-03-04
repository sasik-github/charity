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

    use ValidatesRequests;

    /**
     * количество элементе на странице
     * @var int
     */
    protected $pagination = 5;
}