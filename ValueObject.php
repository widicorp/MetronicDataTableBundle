<?php

/*
 * This file is part of the Widicorp KafkaBundle package.
 *
 * (c) Widicorp <info@widitrade.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Widicorp\MetronicDataTableBundle;

/**
 * Immutable value object.
 */
class ValueObject
{
    /**
     * Checks whether specified property exists.
     *
     * @param string $name name of the property
     *
     * @return bool TRUE if the property exists, FALSE otherwise
     */
    public function __isset(string $name): bool
    {
        return property_exists($this, $name);
    }

    /**
     * Returns current value of specified property.
     *
     * @param string $name name of the property
     *
     * @throws \BadMethodCallException if the property doesn't exist
     *
     * @return mixed current value of the property
     */
    public function __get(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new \BadMethodCallException(sprintf('Unknown property "%s" in class "%s".', $name, get_class($this)));
        }

        return $this->$name;
    }

    /**
     * Prevents object's properties from modification.
     *
     * @param string $name  name of the property
     * @param mixed  $value new value of the property
     */
    final public function __set(string $name, $value)
    {
    }
}
