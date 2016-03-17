<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 2:55 PM
 */

namespace App\Models\Repositories;


use App\Models\Token;

class TokenRepository
{

    /**
     * @param $token
     * @return Token
     */
    public function getByToken($token)
    {
        return Token::where('token', $token)->first();
    }
}