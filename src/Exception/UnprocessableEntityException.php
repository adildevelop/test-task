<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class UnprocessableEntityException extends Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message, 422, null);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return __CLASS__ . "[{$this->code}]: {$this->message}\n";
    }
}