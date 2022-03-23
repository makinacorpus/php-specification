<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

use MakinaCorpus\Specification\Generic\GenericTrait;

abstract class CompositeSpecification implements Specification
{
    use GenericTrait;

    private ?string $type = null;

    public function __construct(?string $type = null)
    {
        $this->type = $type ? \ltrim($type, '\\') : null;
        $this->setSupportedTypes($type);
    }

    /**
     * Real implementation of isSatisfiedBy().
     */
    protected abstract function doIsSatisfiedBy(object $object): bool;

    /**
     * Test compatibility between another spec.
     */
    protected function isCompatibleWith(Specification $other): bool
    {
        return !$this->type || $other->supportsType($this->type);
    }

    /**
     * Test compatibility between another spec.
     */
    protected function isCompatibleWithOrDie(Specification $other): void
    {
        if (!$this->isCompatibleWith($other)) {
            throw new \DomainException(\sprintf("Given specification is not compatible with type: %s", $this->type));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy(object $object): bool
    {
        return $this->supportsObject($object) && $this->doIsSatisfiedBy($object);
    }

    /**
     * {@inheritdoc}
     */
    public function and(Specification $other): Specification
    {
        return new AndSpecification($this, $other);
    }

    /**
     * {@inheritdoc}
     */
    public function andNot(Specification $other): Specification
    {
        return new AndSpecification($this, $other->not());
    }

    /**
     * {@inheritdoc}
     */
    public function or(Specification $other): Specification
    {
        return new OrSpecification($this, $other);
    }

    /**
     * {@inheritdoc}
     */
    public function orNot(Specification $other): Specification
    {
        return new OrSpecification($this, $other->not());
    }

    /**
     * {@inheritdoc}
     */
    public function not(): Specification
    {
        return new NotSpecification($this);
    }
}
