<?php

declare(strict_types=1);

namespace Takeoto\Message;

use Takeoto\Message\Contract\ErrorMessageInterface;

class ErrorMessage extends Message implements ErrorMessageInterface
{
    /**
     * @var int|string
     */
    private $code;

    /**
     * @param string|int $code
     * @param string $template
     * @param array<string,mixed> $variables
     */
    public function __construct($code, string $template, array $variables = [])
    {
        $this->code = $code;
        parent::__construct($template, $variables);
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->code;
    }
}