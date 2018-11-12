<?php

namespace ApplicationInsightsCake\Error;

use Cake\Error\ExceptionRenderer;

class AiErrorRenderer extends ExceptionRenderer
{
    public function missingWidget($error)
    {
        $response = $this->controller->response;

        return $response->withStringBody('Oops that widget is missing.');
    }
}

?>