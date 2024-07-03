<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Handler extends ExceptionHandler
{
    use ResponseTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $status = 500;
            $message = 'Something went wrong';

            if ($exception instanceof NotFoundHttpException) {
                $status = 404;
                $message = 'Resource not found';
            }elseif ($exception instanceof ModelNotFoundException) {
                $status = 404;
                $message = class_basename($exception->getModel()).' not found';

            }

           return $this->sendError($message, [class_basename($exception->getModel()).' model not found'], $status);
        }

        return parent::render($request, $exception);
    }
}