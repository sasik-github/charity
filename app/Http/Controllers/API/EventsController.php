<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 10:02 PM
 */

namespace App\Http\Controllers\API;


use App\Models\Event;
use App\Models\Repositories\EventRepository;
use App\Models\Volunteer;
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


    /**
     * @api {get} /events/by-date/{timestamp} получить все события по $timestamp дате
     * @apiName getEventsByDate
     * @apiGroup Events
     *
     * @apiParam {Int} timestamp таймстэмп даты, на которую вы хотите получить события
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
        [
            {
                "id": 1,
                "name": "супер событие",
                "description": "супер событие",
                "image": "",
                "points": 123,
                "created_at": "2016-03-06 12:45:45",
                "updated_at": "2016-03-09 13:44:35",
                "organizer_id": 1,
                "volunteer_id": 1,
                "place": "",
                "date": "2016-03-09 12:10:00"
            },
            {
                "id": 2,
                "name": "1",
                "description": "1",
                "image": "",
                "points": 1,
                "created_at": "2016-03-09 13:31:41",
                "updated_at": "2016-    03-09 13:31:41",
                "organizer_id": 1,
                "volunteer_id": 1,
                "place": "12",
                "date": "2016-03-09 11:00:01"
            }
        ]
     * @param $timestamp
     * @param EventRepository $eventRepository
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getEventsByDate($timestamp, EventRepository $eventRepository)
    {
        $date = Carbon::createFromTimestamp($timestamp);
        return $eventRepository->getEventsByDate($date);

    }

    /**
     * @api {get} /events/dates/{timestamp} получить все даты по $timestamp дате в текущем месяце
     * @apiName getDateInMonth
     * @apiGroup Events
     *
     * @apiParam {Int} timestamp таймстэмп даты, по месяцу которой, вы хотите получить даты
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
      [
         "09.03.2016",
         "10.03.2016",
         "08.03.2016"
      ]
     * @param $timestamp
     * @param EventRepository $eventRepository
     * @return array
     */
    public function getDateInMonth($timestamp, EventRepository $eventRepository)
    {
        $date = Carbon::createFromTimestamp($timestamp);
        return $eventRepository->getEventDate($date);
    }

    /**
     * @api {get} /events/my-events получить все события пользователя на которые он подписан
     * @apiName getMyEvents
     * @apiGroup Events
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK

     *
     */
    public function getMyEvents()
    {
        return $this->getVolunteer()->events;
    }

    /**
     * @api {get} /events/dates/{timestamp} получить все даты по $timestamp дате в текущем месяце
     * @apiName getDateInMonth
     * @apiGroup Events
     *
     * @apiParam {Int} timestamp таймстэмп даты, по месяцу которой, вы хотите получить даты
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * @param Request $request
     * @param Event $event
     * @return array
     */
    public function acceptEvent(Request $request, Event $event)
    {
        $volunteer = $this->getVolunteer();
        if ($volunteer->events->contains($event)) {
            return ['error' => 'already accepted'];
        }

        $volunteer->events()->attach($event);
        return [];
    }

    /**
     * @return Volunteer
     */
    private function getVolunteer()
    {
        return auth()->user()->volunteer;
    }


}
