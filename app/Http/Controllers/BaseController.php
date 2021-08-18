<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller;

class BaseController extends Controller
{
    /**
     * @param string $text
     * @param array $context
     */
    protected function logInfo(string $text, array $context = [])
    {
        Log::channel('daily')->info($text, $context);
    }
}
