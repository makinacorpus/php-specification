<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

class NeverSpecification extends CompositeSpecification
{
    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return false;
    }
}
