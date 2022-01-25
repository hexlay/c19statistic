<?php

namespace App\Exceptions;

use App\Traits\HasApiRequests;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;
use function get_class;

class Handler extends ExceptionHandler
{
    use HasApiRequests;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api*')) {
                return match (get_class($e)) {
                    ModelNotFoundException::class => $this->error(message: 'Requested entry was not found', code: 404),
                    AuthenticationException::class => $this->error(message: 'Invalid token provided', code: 401),
                    ValidationException::class => $this->validatorError($e->validator),
                    AccessDeniedHttpException::class => $this->error(message: 'Access denied on current route', code: 403),
                    default => $this->exception($e),
                };
            }
            return parent::render($request, $e);
        });
    }
}
