<?php

declare(strict_types=1);

namespace Takeoto\Message;

use Takeoto\Message\Contract\MessageInterface;

class Message implements MessageInterface
{
    private string $template;
    private array $variables;

    /**
     * @param string $template
     * @param array<string,string|\Stringable|int> $variables
     */
    public function __construct(string $template, array $variables = [])
    {
        $this->variables = $variables;
        $this->template = $template;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @inheritDoc
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return strtr($this->template, $this->variables);
    }
}