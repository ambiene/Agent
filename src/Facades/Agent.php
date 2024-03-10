<?php

namespace Ambiene\Agent\Facades;

use Illuminate\Support\Facades\Facade;

class Agent extends Facade
{
    /**
     * @method static string getBrowser(?string $userAgent)
     * @method static string getOperatingSystem(?string $userAgent)
     */
    protected static function getFacadeAccessor()
    {
        return "agent";
    }
}
