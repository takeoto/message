<?php

namespace Takeoto\Message\Contract;

interface MessageInterface
{
    /**
     * Gets the message template.
     *
     * @return string
     */
    public function getTemplate(): string;

    /**
     * Gets message variables.
     *
     * @return array<string,mixed>
     */
    public function getVariables(): array;

    /**
     * Returns a string representation of the message.
     *
     * @return string
     */
    public function __toString(): string;
}