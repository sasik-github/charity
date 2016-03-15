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
use Illuminate\Support\Collection;

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
        $event->image = $this->handleImageName($attributes);
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
        $event->image = $this->handleImageName($attributes);
        $event->update($attributes);

        return $event;
    }

    /**
     * @param $attributes
     * @return string
     */
    private function handleImageName($attributes)
    {
        if (!array_key_exists('filename', $attributes)) {
            return null;
        }

        return $attributes['filename'][0];

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

    /**
     * Получить список курируемых событий
     * @param $volunteerId
     * @return Collection
     */
    public function getAdministratedEventByVolunteerId($volunteerId)
    {
        return WithOrganizationEvent::where('volunteer_id', $volunteerId)->get();
    }
}
