<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    const USERNAME = 'username';
    const PASSWORD = 'password';
    const NAME = 'name';
    const SURNAME = 'surname';
    const SEX = 'sex';
    const EMAIL = 'email';
    const PROFILE_IMAGE = 'profileImage';
    const DESCRIPTION = 'description';
    const LOCATION = 'location';
    const LINKS = 'links';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        User::USERNAME,
        User::NAME,
        User::SURNAME,
        User::SEX,
        User::EMAIL,
        User::PROFILE_IMAGE,
        User::DESCRIPTION,
        User::LINKS,
        User::CREATED_AT,
        User::UPDATED_AT,
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        User::PASSWORD,
    ];
}
