<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

class NotSpecification extends CompositeSpecification
{
    private Specification $decorated;

    public function __construct(Specification $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return !$this->decorated->isSatisfiedBy($object);
    }
}
