<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 10:02 PM
 */

namespace App\Http\Controllers\API;


use App\Models\Event;
use App\Models\Repositories\EventRepository;
use App\Models\Repositories\VolunteerRepository;
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
     * @param EventRepository $eventRepository
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllEvents(EventRepository $eventRepository)
    {
        return $eventRepository->getAll($this->getVolunteer());
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
        return $this->getVolunteer()->WithOrganizerEvents;
    }

    /**
     * @api {post} /events/accept/{event} текущий пользователь принимает участие в {event}
     * @apiName acceptEvent
     * @apiGroup Events
     *
     * @apiParam {Int} event id события
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * @param Event $event
     * @return array
     */
    public function acceptEvent(Event $event)
    {
        $volunteer = $this->getVolunteer();
        if ($volunteer->isAccepted($event)) {
            return ['error' => 'already accepted'];
        }

        $volunteer->events()->attach($event);
        return [];
    }

    /**
     * @api {post} /events/reject/{event} текущий пользователь отказывается принимать участие в {event}
     * @apiName rejectEvent
     * @apiGroup Events
     *
     * @apiParam {Int} event id события
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * @param Event $event
     * @return array
     */
    public function rejectEvent(Event $event)
    {
        $volunteer = $this->getVolunteer();

        if (!$volunteer->isAccepted($event)) {
            return ['error' => 'already rejected'];
        }

        $volunteer->events()->detach($event);

        return [];
    }


    /**
     * @api {get} /events/my-administrated-events Получить список курируемых событий
     * @apiName getMyAdministratedEvents
     * @apiGroup Events
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *
     * @param EventRepository $eventRepository
     * @return \Illuminate\Support\Collection
     */
    public function getMyAdministratedEvents(EventRepository $eventRepository)
    {
        $volunteer = $this->getVolunteer();
        return $eventRepository->getAdministratedEventByVolunteerId($volunteer->id);
    }

    /**
     * @api {get} /events/accepted-volunteers/{event} Получить список волонтеров подписанных на событие {event}
     * @apiName getAcceptedVolunteers
     * @apiGroup Events
     *
     * @apiParam {Int} event id события
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *
     * @param Event $event
     * @return \Illuminate\Support\Collection
     */
    public function getAcceptedVolunteers(Event $event)
    {

        if (!$this->isAdminOfEvent($event)) {
            return ['error' => 'You must be an admin of event'];
        }

        return $event
            ->volunteers()
            ->wherePivot('is_visited', false)
            ->with('user')
            ->get();
    }


    /**
     * @api {post} /events/grant/{event} наградить волонтеров за участие в событие {event}
     * @apiName grantPointsToVolunteers
     * @apiGroup Events
     *
     * @apiParam {Int} event id события
     * @apiParam {array} ids массив ID волонтеров, которых следует наградить
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *  []
     *
     * @param Event $event
     * @param Request $request
     * @param VolunteerRepository $volunteerRepository
     * @return array
     */
    public function grantPointsToVolunteers(Event $event, Request $request, VolunteerRepository $volunteerRepository)
    {
        $volunteerIDs = $request->get('ids', []);
        $volunteerRepository->grantPointsToVolunteers($volunteerIDs, $event);

        return [];
    }

    /**
     * @api {get} /events/is-accepted/{event} Получить статус пользовател, принял не принял событие {event}
     * @apiName isAcceptedEvent
     * @apiGroup Events
     *
     * @apiParam {Int} event id события
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
    {
        "is_accept": false
    }
     *
     * @param Event $event
     * @return \Illuminate\Support\Collection
     */
    public function isAcceptedEvent(Event $event)
    {
        $volunteer = $this->getVolunteer();

        return [
            'is_accept' => $volunteer->isAccepted($event),
            'is_visited' => $volunteer->isVisited($event),
            'is_over' => $event->isOver(),
        ];

    }

    /**
     * является ли текущий волнтер куратором события?
     * @param $event Event
     * @return bool
     */
    private function isAdminOfEvent(Event $event)
    {
        $adminVolunteer = $event->volunteer;

        return $adminVolunteer == $this->getVolunteer();
    }

    /**
     * @return Volunteer
     */
    private function getVolunteer()
    {
        $volunteer = auth()->user()->volunteer;

        if (!$volunteer) {
            abort(404, 'Volunteer not found');
        }

        return $volunteer;
    }


}
