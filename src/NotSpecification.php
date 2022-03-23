<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

class NotSpecification extends CompositeSpecification
{
    private Specification $negated;

    public function __construct(Specification $negated)
    {
        $this->negated = $negated;
    }

    /**
     * Get negated operand.
     */
    public function getNegated(): Specification
    {
        return $this->negated;
    }

    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return !$this->negated->isSatisfiedBy($object);
    }
}
