<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render(
                  $request,
        Throwable $exception
    ) {
        $code = $exception->getCode();
        $message = $exception->getMessage();

        if ($exception instanceof ValidationException) {
            return $this->handleValidationMessage($exception);
        }

        if (method_exists($exception, "getCode")) {
            $code = $exception->getCode();
        }

        if (method_exists($exception, "getStatusCode")) {
            $code = $exception->getStatusCode();
        }

        if ($exception instanceof QueryException) {
            $code    = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Erro ao executar a Query!';
        }

        if ($exception instanceof NotFoundHttpException || $exception instanceof MethodNotAllowedHttpException) {
            $code = Response::HTTP_NOT_FOUND;
            if (null == $message) {
                $message = trans('Rota não existente!');
            }
        }

        if (method_exists($exception, "getMessage")) {
            $message = $exception->getMessage();
        }

        if (empty($code)) {
            $code = 500;
        }
        if (empty($message)) {
            $message = "Erro ao realizar solicitação";
        }

        return apiResponse($message, $code);
    }

    private function handleValidationMessage(ValidationException $e)
    {
        $code          = 400;
        $errorsMessage = [];
        $errors        = $e->validator->errors()->toArray();

        foreach ($errors as $field => $message) {
            $errorsMessage[$field] = $message[0];
        };

        if (!count($errorsMessage) > 0) {
            $code = 500;
        }

        return apiResponse('Erro ao validar os campos', $code, $errorsMessage);
    }
}
