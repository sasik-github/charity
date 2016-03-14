<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 11:57 AM
 */

namespace App\Models\Repositories;


use App\Models\Event;
use App\Models\News;

class NewsesEventRepository
{

    /**
     * @api {get} /newsesevents получить список новостей и событий отсортированных по date и updated_at
     * @apiName getNewsesEvents
     * @apiGroup NewsesEvents
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
    [
        {
            "id": 1,
            "name": "Лучшее событие",
            "description": "риально лучшее",
            "image": "",
            "points": 100,
            "date": "2016-03-24 19:03:00",
            "created_at": "2016-03-09 07:20:56",
            "updated_at": "2016-03-11 02:50:00",
            "organizer_id": 1,
            "volunteer_id": 4,
            "place": "тут",
            "type": "event"
        },
        {
            "id": 1,
            "title": "Пентагон выразил готовность уничтожить ядерный арсенал КНДР1",
            "text": "Ранее северокорейский лидер Ким Чен Ын распорядился подготовить ядерное оружие к применению в любой момент. Он также заявил, что КНДР пересмотрит свою военную доктрину, чтобы быть готовой наносить превентивные удары в связи с текущей ситуацией, представляющей опасность для страны.\r\n\"Оценка правительства США не изменилась. Мы не увидели у Северной Кореи возможности миниатюризировать ядерное оружие или размещать его на межконтинентальных баллистических ракетах\", — заявил собеседник агентства. Он добавил, что \"силы (США) в случае необходимости готовы к ответному уничтожающему удару\".",
            "image": "KOecPZ30E0m0_1000-upload-iblock-1be-airbus-a321.jpg",
            "created_at": "2016-03-04 02:58:13",
            "updated_at": "2016-03-11 05:02:16",
            "type": "news"
        }
    ]
     */
    public function getNewsesEvents()
    {
        $newses = News::all();

        $events = Event::all();

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