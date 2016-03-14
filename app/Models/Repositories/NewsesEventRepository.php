<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 11:57 AM
 */

namespace App\Models\Repositories;


use App\Models\Modifications\WithOrganizationEvent;
use App\Models\News;

class NewsesEventRepository
{


    public function getNewsesEvents()
    {
        $newses = News::all();

        $events = WithOrganizationEvent::all();

        $collection = collect([$newses, $events/*->sort($this->sortByDateOrUpdatedAtCallback())*/]);
        $collection = $collection->collapse();

        $collection = $collection->sort($this->sortByDateOrUpdatedAtCallback())->values();

        return $collection;
    }

    /**
     * так как сортировка по разным классам соответсвено разным полям нужен колбэк которые берет соотвтсвующее поле
     * и сравнивает (News->updated_at, Event->date)
     *
     * @return \Closure
     */
    private function sortByDateOrUpdatedAtCallback()
    {
        return function($first, $second) {

            $firstParam = 'date';
            $secondParam = 'date';

            if ($first instanceof News) {
                $firstParam = 'updated_at';
            }

            if ($second instanceof News) {
                $secondParam = 'updated_at';
            }

//            var_dump([$first->$firstParam, $second->$secondParam, $first->$firstParam->gt($second->$secondParam)]);
            if ($first->$firstParam->eq($second->$secondParam)) {
                return 0;
            }

            return $first->$firstParam->gt($second->$secondParam) ? -1 : 1;

        };
    }
}