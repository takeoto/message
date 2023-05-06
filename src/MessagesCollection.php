<?php

declare(strict_types=1);

namespace Takeoto\Message;

use Takeoto\Message\Contract\ErrorMessageInterface;
use Takeoto\Message\Contract\MessageInterface;
use Takeoto\Message\Contract\MessagesCollectionInterface;
use Takeoto\Message\Contract\NoticeMessageInterface;
use Takeoto\Message\Contract\WarningMessageInterface;
use Takeoto\Message\Utility\MessageUtility;

/**
 * @template TKey
 * @template-covariant T of MessageInterface
 * @template-extends \IteratorAggregate<TKey, T>
 */
class MessagesCollection implements MessagesCollectionInterface
{
    private array $messages;
    private array $typeToMessages;

    /**
     * @param MessageInterface[] $messages
     */
    public function __construct(array $messages)
    {
        $this->messages = $messages;
        $this->typeToMessages = $this->groupByTypes($messages);
    }

    /**
     * @return MessagesCollectionInterface<TKey,WarningMessageInterface>
     */
    public function getNotices(): MessagesCollectionInterface
    {
        return new self($this->typeToMessages[NoticeMessageInterface::class] ?? []);
    }

    /**
     * @return MessagesCollectionInterface<TKey,WarningMessageInterface>
     */
    public function getWarnings(): MessagesCollectionInterface
    {
        return new self($this->typeToMessages[WarningMessageInterface::class] ?? []);
    }

    /**
     * @return MessagesCollectionInterface<TKey,ErrorMessageInterface>
     */
    public function getErrors(): MessagesCollectionInterface
    {
        return new self($this->typeToMessages[ErrorMessageInterface::class] ?? []);
    }

    /**
     * @return T|null
     */
    public function first(): ?MessageInterface
    {
        return reset($this->messages);
    }

    /**
     * @return \Traversable<TKey, T>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->messages);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->messages);
    }

    /**
     * @param MessageInterface[] $messages
     * @return array<class-string,array<int,MessageInterface>>
     */
    private function groupByTypes(array $messages): array
    {
        $typeToMessages = [];

        foreach ($messages as $message) {
            switch (true) {
                case $message instanceof NoticeMessageInterface:
                    $typeToMessages[NoticeMessageInterface::class][] = $message;
                    break;
                case $message instanceof WarningMessageInterface:
                    $typeToMessages[WarningMessageInterface::class][] = $message;
                    break;
                case $message instanceof ErrorMessageInterface:
                    $typeToMessages[ErrorMessageInterface::class][] = $message;
                    break;
                case $message instanceof MessageInterface:
                    break;
                default:
                    throw new \InvalidArgumentException(
                        sprintf(
                            'Message object must implement "%s" interface. %s given',
                            MessageInterface::class,
                            MessageUtility::formatValue($message),
                        )
                    );
            }
        }

        return $typeToMessages;
    }
}