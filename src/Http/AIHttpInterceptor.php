<?php

namespace ApplicationInsightsCake\Http;

use Cake\I18n\Time;
use ApplicationInsights\Telemetry_Client;
use Cake\Core\Configure;

class AIHttpInterceptor
{

    public function __invoke($request, $response, $next)
    {
        $_telemetryClient = new Telemetry_Client();
        $_context = $_telemetryClient->getContext();
        $_context->setInstrumentationKey(Configure::read('ApplicationInsights.InstrumentationKey'));

        $_context->getSessionContext()->setId(session_id());
        $_context->getApplicationContext()->setVer(Configure::version());
        $_context->getDeviceContext()->setOsVersion(php_uname());

        $now = time();
        $start = microtime(true);
        // Calling $next() delegates control to the *next* middleware
        // In your application's queue.
        $response = $next($request, $response);

        $time_elapsed_secs = microtime(true) - $start;
        
        // When modifying the response, you should do it
        $requestName = $request->getParam("controller") . "." . $request->getParam("action");
        $_telemetryClient->trackRequest($requestName, (string)$request->getUri(), $now, $time_elapsed_secs * 1000, 200);        
        $_telemetryClient->flush();
        return $response;
    }
}

?>