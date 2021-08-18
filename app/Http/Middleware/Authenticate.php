<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Http\Request;
use Laravel\Lumen\Http\ResponseFactory;

class Authenticate
{
    /**
     * Handles request and checks whatever auth required or not
     * @param Request $request
     * @param Closure|null $next
     * @return Response|ResponseFactory
     */
    public function handle(Request $request, ?Closure $next)
    {
        if ($this->isAuthRequired() === false) {
            $this->logConnection('Authorization is not required. Request went further.');
            return $this->goFurther($request, $next);
        }

        $userToken = $request->header('userToken');
        $context = [
            'headers' => $request->headers
        ];
        if (empty($userToken)) {
            $this->logConnection('User was blocked due to empty AuthToken.', $context);
            return $this->outputUnauthorizedResponse();
        }

        $tokensArr = $this->getAllowedTokens();
        foreach ($tokensArr as $tokenHolder => $token)
        {
            if ($token === $userToken) {
                $this->logConnection("User '$tokenHolder' successfully passed the authorization with key: $userToken");
                return $this->goFurther($request, $next);
            }
        }

        $this->logConnection("User was blocked due to unsuitable token: '$userToken'", $context);
        return $this->outputUnauthorizedResponse();
    }

    /**
     * @return bool
     */
    protected function isAuthRequired() : bool
    {
        return env('AUTH_REQUIRED', true);
    }

    /**
     * @return array
     */
    protected function getAllowedTokens() : array
    {
        return config('authTokens.tokens');
    }

    /**
     * @param string $text
     * @param array|null $context
     */
    protected function logConnection(string $text, array $context = [])
    {
        Log::channel('daily')->info($text, $context);
    }

    /**
     * @param Request $request
     * @param ?Closure $next
     * @return mixed
     */
    protected function goFurther(Request $request, ?Closure $next)
    {
        return $next($request);
    }

    /**
     * @return Response|ResponseFactory
     */
    protected function outputUnauthorizedResponse()
    {
        return response('Unauthorized. Go away, hackerman, I don\'t like you. Leave your key under the door carpet.', 401);
    }
}
