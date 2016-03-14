<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 8:53 AM
 */

namespace App\Http\Controllers\API;


use App\Models\Repositories\NewsesEventRepository;


class NewsEventController extends BaseController
{

    public function getNewsEvents(NewsesEventRepository $newsesEventRepository)
    {
        $collection = $newsesEventRepository->getNewsesEvents();
        return $collection;

    }
}