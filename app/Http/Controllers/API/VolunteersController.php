<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 9:29 PM
 */

namespace App\Http\Controllers\API;



class VolunteersController extends BaseController
{

    /**
     * @api {get} /authorize получить информацию о пользователе
     * @apiName auth
     * @apiGroup Volunteers
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
        {
            "id": 1,
            "firstname": "Alexandr",
            "lastname": "Spesivtsev",
            "middlename": "Sergeevich",
            "email": null,
            "telephone": "89516021698",
            "is_admin": 0,
            "created_at": "2016-03-06 12:16:30",
            "updated_at": "2016-03-07 14:49:38",
            "volunteer": {
                "id": 1,
                "user_id": 1,
                "birthday": "1991-02-11",
                "workplace": "sdfaASDF",
                "image": "",
                "points": 123,
                "created_at": "2016-03-06 12:16:30",
                "updated_at": "2016-03-06 12:16:30"
            }
        }
     */
    public function auth()
    {
        $user = auth()->user();

        $volunteer = $user->volunteer;

        return $user;
    }
}
