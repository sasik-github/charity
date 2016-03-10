<?php
/**
 * User: sasik
 * Date: 3/9/16
 * Time: 4:04 PM
 */

namespace App\Models\Repositories;


use App\Models\Event;
use App\Models\Modifications\WithOrganizationEvent;
use Carbon\Carbon;

class EventRepository
{

    /**
     * @param $attributes
     * @return Event
     */
    public function create($attributes)
    {
        $event = new Event();
        $this->resolveDatetimePickerProblem($event);
        $event->fill($attributes);
        $event->save();
        return $event;
    }

    /**
     * @param Event $event
     * @param $attributes
     * @return Event
     */
    public function update(Event $event, $attributes)
    {
        $this->resolveDatetimePickerProblem($event);
        $event->update($attributes);

        return $event;
    }

    private function resolveDatetimePickerProblem(Event $event)
    {
        $event->setDateFormat('Y-m-d H:i');
        return $event;
    }

    /**
     * получитс список событий на дату $date
     *
     * @param $date
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getEventsByDate(Carbon $date)
    {
        return WithOrganizationEvent::
            where([['date', '>=', $date->startOfDay()->toDateTimeString()] , ['date', '<=', $date->endOfDay()->toDateTimeString()]])
            ->get();
    }

    /**
     * получить список дней когда есть события $date месяце
     *
     * @param Carbon $date
     * @return array
     */
    public function getEventDate(Carbon $date)
    {
        return array_keys(
            Event::whereMonth('date', '=', $date->month )
                ->whereYear('date', '=', $date->year)
                ->get()
                ->groupBy(function($item) {
                    return $item->date->format('d.m.Y');
            })->toArray());
    }
}
