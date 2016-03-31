<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 2:54 PM
 */

namespace App\Http\Controllers\API;


use App\Models\Repositories\TokenRepository;
use App\Models\Token;
use Illuminate\Http\Request;

class TokensController extends BaseController
{
    /**
     * @api {post} /token Сохранить токен устройства
     * @apiName postToken
     * @apiGroup Tokens
     *
     * @apiParam {String} token Уникальный token устройства из GCM или APNS
     * @apiParam {Int} device_type_id Тип устройства(ANDROID = 1, IOS = 2)
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *
     * @param Request $request
     * @param TokenRepository $tokenRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|static
     */
    public function store(Request $request, TokenRepository $tokenRepository)
    {
        /**
         * @var $user User
         */
        $user = auth()->user();
        if (!$user) {
            return response('User doesn\'t exist', 401);
        }

        $attributes = $request->all();
        $attributes['user_id'] = $user->id;

        $token = $tokenRepository->getByToken($attributes['token']);

        /**
         * если токен существует, только обновляем время
         */
        if ($token) {
            $token->update($attributes);
            return $token;
        }

        $token = Token::create($attributes);
        return $token;
    }
}