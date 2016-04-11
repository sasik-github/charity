<?php
namespace App\Models\Helpers;

use App\Models\User;
use Sasik\SmscGateway\SMSGateway;

/**
 * User: sasik
 * Date: 2/22/16
 * Time: 8:27 PM
 */
class PasswordReseter
{

    private $message = 'Ваш новый пароль: %s';

    /**
     * @var SMSGateway
     */
    private $smsGateway;


    /**
     * PasswordReseter constructor.
     *
     * @param SMSGateway $gateway
     */
    public function __construct(SMSGateway $gateway)
    {
        $this->smsGateway = $gateway;
    }

    public function reset(User $user)
    {
        $newPassword = $this->generatePassword();
        $user->password = $newPassword;
        $user->save();

        $this->smsGateway->send($user->telephone, $this->getMessage($newPassword));

    }

    private function generatePassword($length = 8)
    {
//        $byteSize = $length / 2 + 1;
//        return substr(bin2hex(openssl_random_pseudo_bytes($byteSize)), 0, $length);

        return rand(1000, 9999);
    }

    private function getMessage($password)
    {
        return sprintf($this->message, $password);
    }
}