<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class Handler extends ExceptionHandler
{
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthorizationException || $e instanceof AuthenticationException) {
            $httpCode = ResponseAlias::HTTP_UNAUTHORIZED;
            $statusCode = ResponseAlias::HTTP_UNAUTHORIZED;
            $details['message'] = 'Unauthorized';
        }

        $data = [
            'success' => false,
            'status' => $statusCode,
            'errors' => $details,
        ];

        if (str_starts_with($httpCode, 5) && !config('app.debug')) {
            $data['errors'] = [
                'message' => 'Server error',
            ];
        }

        return response()->json($data, $httpCode);
    }
}
