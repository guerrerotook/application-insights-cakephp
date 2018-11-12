<?php

namespace ApplicationInsightsCake;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use ApplicationInsightsCake\Error\AIErrorHandler;
use ApplicationInsightsCake\Http\AIHttpInterceptor;

/**
 * Plugin for ApplicationInsightsCake
 */
class Plugin extends BasePlugin
{
    public function middleware($middleware)
    {
        $errorHandler = new AIErrorHandler();
        $errorHandler->register();

        $middleware->add(new AIHttpInterceptor());
        // Add middleware here.
        return $middleware;
    }

    public function console($commands)
    {
        // Add console commands here.
        return $commands;
    }

    public function bootstrap(PluginApplicationInterface $app)
    {
        // Add constants, load configuration defaults.
        // By default will load `config/bootstrap.php` in the plugin.
        parent::bootstrap($app);
    }

    public function routes($routes)
    {
        // Add routes.
        // By default will load `config/routes.php` in the plugin.
        parent::routes($routes);
    }
}
