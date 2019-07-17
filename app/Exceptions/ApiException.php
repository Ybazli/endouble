<?php


namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function report()
    {

    }

    public function render()
    {
        return response()->json([
            'status' => 'error',
            'description' => 'the source id not recognized!'
        ] , 400);
    }

}
