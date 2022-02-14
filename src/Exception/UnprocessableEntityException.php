<?php

declare(strict_types=1);

namespace App\Exception;

class UnprocessableEntityException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message, 422, null);
    }

    public function __toString(): string
    {
        return __CLASS__ . "[{$this->code}]: {$this->message}\n";
    }
}