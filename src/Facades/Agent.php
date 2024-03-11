<?php

namespace Ambiene\Agent\Facades;

use Illuminate\Support\Facades\Facade;

class Agent extends Facade
{
    /**
     * Facade
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return "agent";
    }
}
