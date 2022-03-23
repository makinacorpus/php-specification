<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

use MakinaCorpus\Specification\CompositeSpecification;

class MockFalseSpecification extends CompositeSpecification
{
    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return false;
    }
}
