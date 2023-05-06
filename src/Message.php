<?php

declare(strict_types=1);

namespace Takeoto\Message;

use Takeoto\Message\Contract\MessageInterface;
use Takeoto\Message\Utility\MessageUtility;

class Message implements MessageInterface
{
    private string $template;
    private array $variables;
    private ?\Closure $normalizer;

    /**
     * @param string $template
     * @param array<string,string|\Stringable|int> $variables
     * @param \Closure(mixed $value, string $placeholder):string|null $normalizer
     */
    public function __construct(string $template, array $variables = [], \Closure $normalizer = null)
    {
        $this->variables = $variables;
        $this->template = $template;
        $this->normalizer = $normalizer;
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
        $normalizer = null === $this->normalizer
            ? static fn($v, string $p): string => MessageUtility::formatVar($v)
            : $this->normalizer;

        $variables = [];

        foreach ($this->variables as $placeholder => $value) {
            $variables[$placeholder] = $normalizer($value, $placeholder);
        }

        return strtr($this->template, $variables);
    }
}