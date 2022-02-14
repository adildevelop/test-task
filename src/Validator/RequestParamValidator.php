<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\UnprocessableEntityException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestParamValidator
{
    private ValidatorInterface $validator;

    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    public function validate(array $params): void
    {
        $violations = $this->validator->validate($params['text'], [
            new NotBlank()
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                throw new UnprocessableEntityException($violation->getMessage());
            }
        }
    }
}