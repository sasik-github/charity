<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 9:29 PM
 */

namespace App\Http\Controllers\API;



use App\Models\Repositories\EventRepository;
use App\Models\Repositories\VolunteerRepository;
use Illuminate\Http\Request;
use Validator;

class VolunteersController extends BaseController
{
    /**
     * @var User
     */
    private $user;

    /**
     * VolunteersController constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }


    /**
     * @api {get} /authorize получить информацию о пользователе
     * @apiName auth
     * @apiGroup Volunteers
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     * "id": 1,
     * "firstname": "Alexandr",
     * "lastname": "Spesivtsev",
     * "middlename": "Sergeevich",
     * "email": null,
     * "telephone": "89516021698",
     * "is_admin": 0,
     * "created_at": "2016-03-06 12:16:30",
     * "updated_at": "2016-03-07 14:49:38",
     * "volunteer": {
     * "id": 1,
     * "user_id": 1,
     * "birthday": "1991-02-11",
     * "workplace": "sdfaASDF",
     * "image": "",
     * "points": 123,
     * "created_at": "2016-03-06 12:16:30",
     * "updated_at": "2016-03-06 12:16:30"
     * }
     * }
     * @param EventRepository $eventRepository
     * @return User
     */
    public function auth(EventRepository $eventRepository)
    {
        $volunteer = $this->user->volunteer;
        $hasEvents = false;
        if ($volunteer) {
            $hasEvents = $eventRepository->getAdministratedEventByVolunteerId($volunteer->id)->count() > 0;
        }
        $this->user->has_events = $hasEvents;
        return $this->user;
    }

    /**
     *
     * /**
     * @api {post} /user/register регистрация пользователя  (BASIC AUTH не нужен)
     * @apiName register
     * @apiGroup Volunteers
     *
     * @apiParam {String} firstname имя
     * @apiParam {String} lastname  фамилия
     * @apiParam {String} middlename  отчество
     * @apiParam {String} [email] почта
     * @apiParam {String} telephone телефон (Unique)
     * @apiParam {String} password пароль
     * @apiParam {Date} [birthday] день рождения
     * @apiParam {String} [workplace] место работы
     * @apiParam {String} [image] имя картинки, должно быть предварительно сохранена
     * @apiParam {Integer} [points] количество балов
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *
     *
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422
     *     {
                "errors": {
                    "lastname": [
                        "The lastname field is required."
                    ],
                    "firstname": [
                        "The firstname field is required."
                    ],
                    "middlename": [
                        "The middlename field is required."
                    ],
                    "telephone": [
                        "The telephone field is required."
                    ],
                    "password": [
                        "The password field is required."
                    ]
                }
            }
     *
     * @param Request $request
     * @param VolunteerRepository $volunteerRepository
     * @return \App\Models\Volunteer|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, VolunteerRepository $volunteerRepository)
    {

        $validator = Validator::make($request->all(), $volunteerRepository->getValidationRules());

        if ($validator->fails()) {
            return response(['errors' => $validator->messages()], 422);
        }

        $volunteer = $volunteerRepository->create($request->all());
        return $volunteer;
    }

    /**
     *
     * /**
     * @api {post} /user/update обновить информацию о пользователе(к этому запросу уже надо подстовлять BASIC AUTH)
     * @apiName update
     * @apiGroup Volunteers
     *
     * @apiParam {String} firstname имя
     * @apiParam {String} lastname  фамилия
     * @apiParam {String} middlename  отчество
     * @apiParam {String} [email] почта
     * @apiParam {String} telephone телефон (Unique)
     * @apiParam {String} password пароль
     * @apiParam {Date} [birthday] день рождения
     * @apiParam {String} [workplace] место работы
     * @apiParam {String} [image] имя картинки, должно быть предварительно сохранена
     * @apiParam {Integer} [points] количество балов
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *
     *
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422
     *
     * @param Request $request
     * @param VolunteerRepository $volunteerRepository
     * @return \App\Models\Volunteer|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, VolunteerRepository $volunteerRepository)
    {
        $volunteer = $this->user->volunteer;
        $validator = Validator::make($request->all(), $volunteerRepository->getValidationRules($volunteer->user_id));

        if ($validator->fails()) {
            return response(['errors' => $validator->messages()], 422);
        }

        $volunteer = $volunteerRepository->update($volunteer, $request->all());
        return [];
    }

}
