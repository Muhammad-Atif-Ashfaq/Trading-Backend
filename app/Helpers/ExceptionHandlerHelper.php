<?php
namespace App\Helpers;

class ExceptionHandlerHelper extends Helper
{

    // TODO: This method executes a callback within a try-catch block and handles any exceptions that occur.
    // TODO: It returns the result of the callback if successful, otherwise sends a server error response.
    public static function tryCatch($callback)
    {
        try {
            return $callback();
        } catch (\Exception $e) {
            return self::sendSeverError('Something went wrong! Please try again later',
                $e->getMessage()
            );
        }
    }

}

