<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\UnprocessableEntityException;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Url;
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
            new NotBlank(null, "\"text\" field value should not be blank")
        ]);

        $violations->addAll($this->validator->validate($params['price'], [
            new NotBlank(null, "\"price\" field value should not be blank"),
            new Positive(null, "\"price\" field value should be numeric and more than zero")
        ]));

        $violations->addAll($this->validator->validate((int) $params['limit'], [
            new NotBlank(null, "\"limit\" field value should not be blank"),
            new Positive(null, "\"limit\" field value should be numeric and more than zero")
        ]));

        $violations->addAll($this->validator->validate($params['banner'], [
            new NotBlank(null, "\"banner\" field value should not be blank"),
            new Url(null, "\"banner\" field contains invalid banner link")
        ]));

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                throw new UnprocessableEntityException($violation->getMessage());
            }
        }
    }
}