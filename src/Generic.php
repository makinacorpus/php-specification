<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

/**
 * PHP has no generics, we have to emulate with runtime checks.
 */
interface Generic
{
    /**
     * Does this instance supports the given type.
     */
    public function supportsType(string $type): bool;

    /**
     * Does this instance supports the given object.
     */
    public function supportsObject(object $object): bool;
}
