<?php

namespace ApplicationInsightsCake\Error;

use Cake\Error\BaseErrorHandler;
use ApplicationInsights\Telemetry_Client;
use ApplicationInsights\Channel\Contracts;
use ApplicationInsights\Channel\Contracts\Message_Severity_Level;
use Cake\Core\Configure;

class AIErrorHandler extends BaseErrorHandler
{
    public static function getTelemetryClient()
    {
        $_telemetryClient = new Telemetry_Client();

        $_context = $_telemetryClient->getContext();
        $_context->setInstrumentationKey(Configure::read('ApplicationInsights.InstrumentationKey'));
        $_context->getDeviceContext()->setOsVersion(php_uname());

        $_context->getSessionContext()->setId(session_id());
        $_context->getApplicationContext()->setVer(Configure::version());

        return $_telemetryClient;
    }

    public function _displayError($error, $debug)
    {
        echo $error;
        echo $debug;
    }

    public function _displayException($exception)
    {
        $_telemetryClient = AIErrorHandler::getTelemetryClient();
        $_telemetryClient->trackException($exception);
        $telemetryResponse = $_telemetryClient->flush();
        // echo 'There has been an exception!';
       
        echo php_uname();
        echo "<br>";
        echo PHP_OS;

        echo $telemetryResponse;
        echo $exception;
    }

    public function handleFatalError($code, $description, $file, $line)
    {
        $_telemetryClient = AIErrorHandler::getTelemetryClient();
        $_telemetryClient->trackMessage($description, Message_Severity_Level::ERROR);
        $_telemetryClient->flush();
    }
}

?>