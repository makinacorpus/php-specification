<?php

declare(strict_types=1);

namespace MakinaCorpus\Specification;

/**
 * Helper for fetching arbitrary data on objects.
 */
final class ValueAccessor
{
    /**
     * Get property value in object.
     *
     * Property name resolution follows this algorithm:
     *   - If a property has the same name, fetch its value and return it.
     *   - If no property is found, attempt using a method name, if the method
     *     has no required parameters (all have a default value or are nullable)
     *     then return the value the method will return.
     *
     * @todo a named property can be "null", handle this using the option
     *   pattern to return the value
     */
    public static function getValueFrom(object $object, string $propertyName): mixed
    {
        if ($value = self::getValueFromProperty($object, $propertyName)) {
            return $value;
        }
        return self::getValueFromMethod($object, $propertyName);
    }

    /**
     * Set property value in object.
     *
     * Property will be statically accessed via reflexion and a scope stealing
     * closure, do not abuse of this code. This code can raise type errors.
     */
    public static function getValueInto(object $object, string $propertyName, mixed $value): void
    {
        try {
            $ref = new \ReflectionProperty($object, $propertyName);

            if ($ref->isPublic()) {
                $object->{$propertyName} = $value;
            } else {
                (\Closure::bind(
                    function () use ($object) {
                        $object->{$propertyName} = $value;
                    },
                    $object,
                    \get_class($object)
                ))();
            }
        } catch (\ReflectionException $e) {
            throw new \InvalidArgumentException(\sprintf("Property %s::\$%s does not exist.", \get_class($object), $propertyName), $e->getCode(), $e);
        }
    }

    /**
     * Attempt to find named property and return its value.
     */
    private static function getValueFromProperty(object $object, string $propertyName): mixed
    {
        try {
            $ref = new \ReflectionProperty($object, $propertyName);

            if ($ref->isPublic()) {
                return $object->{$propertyName};
            }

            return (\Closure::bind(
                fn () => $object->{$propertyName},
                $object,
                \get_class($object)
            ))();
        } catch (\ReflectionException $e) {
            return null; // Property does not exist, fallback.
        }
    }

    /**
     * Attempt to find named method with no required parameters and return its return.
     */
    private static function getValueFromMethod(object $object, string $methodName): mixed
    {
        try {
            $ref = new \ReflectionMethod($object, $methodName);

            // We can call the method only if all parameters are optional.
            foreach ($ref->getParameters() as $parameter) {
                if (!$parameter->isOptional()) {
                    return null;
                }
            }

            if ($ref->isPublic()) {
                return $object->{$methodName}();
            }

            return (\Closure::bind(
                fn ($victim) => $victim->{$methodName}(),
                $object,
                \get_class($object)
            ))($object);

        } catch (\ReflectionException $e) {
            return null; // Method does not exist, fallback.
        }
    }
}
