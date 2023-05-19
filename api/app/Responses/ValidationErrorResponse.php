<?php

namespace App\Responses;
use stdClass;

class ValidationErrorResponse
{
    public function makeError(string $message): stdClass
    {
        $error = new stdClass();
        $error->message = $message;
        $error->errors = new stdClass();
        $error->errors->json = [$message];
        return $error;
    }
}
