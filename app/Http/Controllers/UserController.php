<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
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
            $this->logInfo("User '$username' doesn't exist. Returned error 404.");
            return new Response(null, 404);
        }
        $responseBody = $user->toJson();
        $this->logInfo("Loaded info for user: '$username'.", ['Response body', $responseBody]);
        return new Response($user->toJson(), 400);
    }

    /**
     * @param string $text
     * @param array $context
     */
    protected function logInfo(string $text, array $context = [])
    {
        Log::channel('daily')->info($text, $context);
    }
}
