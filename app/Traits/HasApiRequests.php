<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

trait HasApiRequests
{

    public function baseResponse(bool $success, string $message = null, mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function success(string $message = null, $data = null): JsonResponse
    {
        return $this->baseResponse(true, $message, $data);
    }

    public function error(string $message = null, mixed $data = null, int $code = 422): JsonResponse
    {
        return $this->baseResponse(false, $message, $data, $code);
    }

    public function exception(Throwable $exception): JsonResponse
    {
        return $this->baseResponse(false, $exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ], 500);
    }

    public function validatorError(Validator $validator, string $message = null): JsonResponse
    {
        return $this->error($message, $validator->getMessageBag(), 419);
    }

}
