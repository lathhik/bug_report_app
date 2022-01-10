<?php

namespace App\Exception;

use App\Helpers\App;
use ErrorException;
use Throwable;

class ExceptionHandler
{
    /**
     * @param Throwable
     */
    public function handle(Throwable $exception): void
    {
        $application = new App;
        if ($application->isDebugged()) {
            var_dump($exception);
        } else {
            echo "Something went wrong, please try again";
        }
        exit;
    }


    /**
     * @param mixed 
     */
    public function convertWarningsAndNoticesToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
     }
}
