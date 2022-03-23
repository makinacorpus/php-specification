<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

abstract class OperandSpecification extends CompositeSpecification
{
    protected Specification $left;
    protected Specification $right;

    public function __construct(Specification $left, Specification $right)
    {
        // @todo Method is not part of interface.
        $left->isCompatibleWithOrDie($right);

        $this->left = $left;
        $this->right = $right;
    }

    /**
     * Get left operand.
     */
    public function getLeft(): Specification
    {
        return $this->left;
    }

    /**
     * Get right operand.
     */
    public function getRight(): Specification
    {
        return $this->right;
    }
}
