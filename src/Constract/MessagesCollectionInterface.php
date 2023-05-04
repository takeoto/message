<?php

namespace Takeoto\Message\Contract;

/**
 * @template TKey
 * @template-covariant T of MessageInterface
 * @template-extends \IteratorAggregate<TKey, T>
 */
interface MessagesCollectionInterface extends \Countable, \IteratorAggregate
{
    /**
     * @return MessagesCollectionInterface<TKey,NoticeMessageInterface>
     */
    public function getNotices(): MessagesCollectionInterface;

    /**
     * @return MessagesCollectionInterface<TKey,WarningMessageInterface>
     */
    public function getWarnings(): MessagesCollectionInterface;

    /**
     * @return MessagesCollectionInterface<TKey,ErrorMessageInterface>
     */
    public function getErrors(): MessagesCollectionInterface;

    /**
     * @return T|null
     */
    public function first(): ?MessageInterface;
}