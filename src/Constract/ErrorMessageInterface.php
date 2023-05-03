<?php

namespace Takeoto\Message\Contract;

interface ErrorMessageInterface extends MessageInterface
{
    /**
     * Gets the error code.
     *
     * @return string
     */
    public function getCode(): string;
}