<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 10:02 PM
 */

namespace App\Http\Controllers\API;


use App\Models\Event;
use App\Models\Repositories\EventRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends BaseController
{


    /**
     * @api {get} /events получить все события
     * @apiName getAllEvents
     * @apiGroup Events
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *          {
     *              "id": 1,
     *              "name": "супер событие",
     *              "description": "супер событие",
     *              "image": "",
     *              "points": 123,
     *              "date": "2016-04-12",
     *              "created_at": "2016-03-06 12:45:45",
     *              "updated_at": "2016-03-06 13:15:51",
     *              "organizer_id": 1,
     *              "volunteer_id": 1
     *           },
     *          ...
     *
     *       ]
     */
    public function getAllEvents()
    {
        return Event::all();
    }

    public function getEventsByDate($date, EventRepository $eventRepository)
    {
        $date = Carbon::createFromTimestamp(time());
        return $eventRepository->getEventsByDate($date);

    }

    public function getDateInMonth($date, $eventRepository)
    {
        $date = Carbon::createFromTimestamp(time());
        return $eventRepository->getEventDate($date);
    }


}
