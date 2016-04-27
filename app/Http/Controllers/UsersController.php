<?php
/**
 * User: sasik
 * Date: 4/27/16
 * Time: 8:25 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UsersController extends BaseController
{

    protected $resourcePrefix = 'users.users';

    public function getChangePassword()
    {
        return $this->view('ChangePassword');
    }

    public function postChangePassword(Request $request)
    {

        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
        ];

        $user = auth()->user();
        $validator = \Validator::make($request->all(), $rules);
        $validator->after(function($validator) use ($request, $user) {
            if (!\Hash::check($request->get('old_password'), $user->password)) {
                $validator
                    ->errors()
                    ->add('old_password', 'Вы указали неверный старый пароль');
            }
        });

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $user->password = $request->get('password');
        $user->save();

        \Flash::success('Ваш пароль успешно изменен!');

        return redirect()
            ->back();
    }
}
