<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    public function getUserPageInfo($username): Response
    {
        /**
         * @var User $user
         */
        $user = User::where([User::USERNAME => $username])->first();

        if($user === null) {
            $this->logInfo("User '$username' doesn't exist. Returned error 404.");
            return new Response(null, 404);
        }
        $responseBody = $user->toJson();
        $this->logInfo("Loaded info for user: '$username'.", ['Response body', $responseBody]);
        return new Response($responseBody, 200);
    }
}
