<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Generic;

/**
 * If type string is identical, types are compatible.
 *
 * If current type is an interface, other type must implement when a class or
 * extend when an interface current type in order to be compatible.
 *
 * If current type is a class, other type must extend this type to be supported.
 */
class GenericSupportedType
{
    /* 1 = class, 2 = interface, 3 = other. */
    private int $type;
    private string $name;

    public function __construct(string $name)
    {
        if (\class_exists($name) || \interface_exists($name)) {
            $ref = new \ReflectionClass($name);
            $this->type = $ref->isInterface() ? 2 : 1;
            $this->name = $ref->name;
        } else {
            $this->name = $name;
            $this->type = 3;
        }
    }

    public function isCompatible(object $other): bool
    {
        if (!$other instanceof GenericSupportedType) {
            $other = new GenericSupportedType(\get_class($other));
        }

        if ($this->name === $other->name) {
            return true;
        }

        switch ($this->type) {

            case 1: // Class.
                return 1 === $other->type && \is_subclass_of($other->name, $this->name);

            case 2: // Interface.
                $ref = new \ReflectionClass($other->name);
                if (1 === $other->type) {
                    return $ref->implementsInterface($this->name);
                } else if (2 === $other->type) {
                    return $ref->isSubclassOf($this->name);
                }
                return false;

            default: // Other.
                return false;
        }
    }
}
