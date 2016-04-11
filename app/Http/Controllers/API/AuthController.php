<?php
/**
 * User: sasik
 * Date: 4/11/16
 * Time: 9:48 AM
 */

namespace App\Http\Controllers\API;


use App\Models\Helpers\PasswordReseter;
use App\Models\Repositories\UserRepository;

class AuthController extends BaseController
{

    /**
     * @api {get} /auth/user-is-exist/:telephone Получить информации о пользователе, если он существует
     * @apiName getUserIsExist
     * @apiGroup Auth
     *
     * @apiParam {Number} telephone Уникальный номер телефона
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     * "id": 1,
     * "name": "Alex",
     * "telephone": "89516021698",
     * "email": "dart_sas@mail.ru",
     * "role_id": 1,
     * "created_at": "2016-02-25 02:24:32",
     * "updated_at": "2016-02-25 02:24:32"
     * }
     *
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 User not Found
     *
     * @param $telephone
     * @param UserRepository $userRepository
     * @return User
     */
    public function getUserIsExist($telephone, UserRepository $userRepository)
    {

        $user = $userRepository->getUserByTelephone($telephone);
        if (!$user) {
            return response('User not Found', 404);
        }

        return $user;
    }

    /**
     * @api {post} /auth/reset-password/:telephone Сбросить пароль у пользователя
     * @apiName postResetPassword
     * @apiGroup Auth
     *
     * @apiParam {Number} telephone Уникальный номер телефона, у кого сбрасываем пароль, на этот номер придет SMS с паролем
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * []
     *
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 User not Found
     *
     * @param $telephone
     * @param PasswordReseter $passwordReseter
     * @param UserRepository $userRepository
     * @return array
     */
    public function postResetPassword( $telephone, PasswordReseter $passwordReseter, UserRepository $userRepository)
    {
        $user = $userRepository->getUserByTelephone($telephone);

        if (!$user) {
            return response('User not Found', 404);
        }

        $passwordReseter->reset($user);
        return [];


    }

}