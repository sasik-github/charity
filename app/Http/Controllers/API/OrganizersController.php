<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 10:04 PM
 */

namespace App\Http\Controllers\API;


use App\Models\Organizer;

class OrganizersController extends BaseController
{

    /**
     * @api {get} /organizers получить всех организаторов
     * @apiName getAllOrganizers
     * @apiGroup Organizers
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     [
     *          {
                    "id": 1,
                    "name": "Супер организатор",
                    "description": "огранизуем хуйня всякую",
                    "manager": "Сашка 11",
                    "contacts": "89516021698",
                    "image": "",
                    "address": "Советский проспект 77 комната 526",
                    "created_at": "2016-03-06 11:28:10",
                    "updated_at": "2016-03-06 11:52:00"
                }
     *          ...
     *
     *       ]
     */
    public function getAllOrganizers()
    {
        return Organizer::all();
    }

}
