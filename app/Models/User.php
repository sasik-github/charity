<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public static $rules = [
        'lastname' => 'required|max:50',
        'firstname' => 'required|max:50',
        'middlename' => 'required|max:50',
//        'email' => 'required|email|max:255|unique:users',
        'email' => 'email|max:255|unique:users',
        'telephone' => 'required|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'email',
        'telephone',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * это для того что бы Email был либо null либо unique
     * @param $value
     */
    public function setEmailAttribute($value)
    {
        if ( empty($value) ) { // will check for empty string, null values, see php.net about it
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }

    /**
     * так как у нас нет поля name переопределяем через имя фамилию
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }
}
