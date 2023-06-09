<?php

declare(strict_types=1);

namespace Takeoto\Message\Contract;

interface ErrorMessageInterface extends MessageInterface
{
    /**
     * Gets the error code.
     *
     * @return string|int
     */
    public function getCode();
}