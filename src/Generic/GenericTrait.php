<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Generic;

/**
 * Generic implementation for objects with a single type.
 */
trait GenericTrait /* implements Generic */
{
    /** @var GenericSupportedType[] */
    private array $genericSupportedTypes = [];

    /**
     * Set supported types.
     */
    private function setSupportedTypes(/* null|array|string */ $types): void
    {
        $this->genericSupportedTypes = \array_map(fn (string $name) => new GenericSupportedType($name), (array) $types);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsType(string $type): bool
    {
        if (!$this->genericSupportedTypes) {
            return true;
        }
        $other = new GenericSupportedType($type);
        foreach ($this->genericSupportedTypes as $supported) {
            return $supported->isCompatible($other);
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsObject(object $object): bool
    {
        if (!$this->genericSupportedTypes) {
            return true;
        }
        foreach ($this->genericSupportedTypes as $type) {
            if ($type->isCompatible($object)) {
                return true;
            }
        }
        return false;
    }
}
