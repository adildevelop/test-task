<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\UnprocessableEntityException;
use App\Validator\RequestParamValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    private int $code = 200;
    private string $message = "OK";

    public function nullOrExceptionResponse(array $params): ?Response
    {
        return (!$this->validateRequest($params)) ? $this->json() : null;
    }

    protected function json(array $data = null): Response
    {
        return new JsonResponse([
            'message' => $this->message,
            'code' => $this->code,
            'data' => $data
        ], $this->code);
    }

    private function validateRequest(array $params): bool
    {
        $validator = new RequestParamValidator();

        try {
            $validator->validate($params);
        } catch (UnprocessableEntityException $exception) {
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
            return false;
        }

        return true;
    }
}