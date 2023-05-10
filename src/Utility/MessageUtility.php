<?php

declare(strict_types=1);

namespace Takeoto\Message\Utility;

class MessageUtility
{
    /**
     * @param mixed $value
     * @param bool $detailed
     * @return string
     */
    public static function formatVar($value, bool $detailed = false): string
    {
        switch (true) {
            case \is_object($value):
                if (!$detailed) {
                    return 'object';
                }

                return method_exists($value, '__toString') ? (string)$value : 'object{' . serialize($value) . '}';
            case \is_array($value):
                return $detailed && array_walk(
                    $value,
                    fn(&$v, $k) => $v = self::formatVar($k, true) . ': ' . self::formatVar($v, true)
                ) ? 'array[' . implode(', ', $value) . ']' : 'array';
            case \is_string($value):
                return '"' . $value . '"';
            case \is_resource($value):
                return 'resource';
            case null === $value:
                return 'null';
            case false === $value:
                return 'false';
            case true === $value:
                return 'true';
            default:
                return (string)$value;
        }
    }
}