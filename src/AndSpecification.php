<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

class AndSpecification extends OperandSpecification
{
    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return $this->left->isSatisfiedBy($object) && $this->right->isSatisfiedBy($object);
    }
}
