<?php

namespace StrictPhp\TypeChecker\TypeChecker;

use StrictPhp\TypeChecker\TypeCheckerInterface;

final class ArrayTypeChecker implements TypeCheckerInterface
{
    /**
     * @var callable|null
     */
    private static $failingCallback;

    /**
     * {@inheritDoc}
     */
    public function canApplyToType($type)
    {
        return strtolower($type) === 'array';
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, $type)
    {
        return is_array($value);
    }

    /**
     * {@inheritDoc}
     */
    public function simulateFailure($value, $type)
    {
        $callback = self::$failingCallback ?: self::$failingCallback = function (array $value) {
            return $value;
        };

        $callback($value);
    }
}