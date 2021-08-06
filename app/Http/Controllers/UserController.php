<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function getUserPageInfo($username)
    {
        /**
         * @var User $user
         */
        $user = User::where([User::USERNAME => $username])->first();

        if($user === null) {
            return new Response(null, 404);
        }
        return new Response($user->toJson(), 400);
    }
}
