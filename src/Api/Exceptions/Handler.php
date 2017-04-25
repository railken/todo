<?php

namespace Api\Exceptions;

use Railken\Laravel\App\Exceptions\ExceptionHandler;
use Exception;
use Railken\Laravel\Manager\Exceptions\MissingParamException;
use Railken\Laravel\Manager\Exceptions\ModelByIdNotFoundException;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $exceptions = [
        MissingParamException::class,
        ModelByIdNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'not found'
                ], 404);
            }

            $exceptions = collect($this->exceptions);
            
            $in = $exceptions->search(function ($class, $key) use ($exception) {
                return $exception instanceof $class;
            });




            if ($in !== false) {
                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ], 404);
            }
        }
        # Return only if render is different
        // return parent::render($request, $exception);
    }
}
