<?php

namespace Ambiene\Agent;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('agent', function () {
            return new Agent();
        });
    }
}
