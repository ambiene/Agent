<?php

namespace Ambiene\Agent;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . "/../config/agent.php" => config_path("agent.php"),
            ],
            "config"
        );
    }

    public function register()
    {
        $this->app->singleton("agent", concrete: fn($app) => new Agent());
    }
}
