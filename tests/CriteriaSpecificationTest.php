<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

use MakinaCorpus\Specification\CriteriaSpecification;
use PHPUnit\Framework\TestCase;

class CriteriaSpecificationTest extends TestCase
{
    public function testCriteria(): void
    {
        $spec = new CriteriaSpecification('privateProperty', 'this is private');
        self::assertTrue($spec->isSatisfiedBy(new MockObject()));

        $spec = new CriteriaSpecification('privateProperty', 'this is NOT private');
        self::assertFalse($spec->isSatisfiedBy(new MockObject()));
    }

    public function testCriteriaWithAccessor(): void
    {
        $spec = new CriteriaSpecification('privateProperty', 'this is private', MockObject::class, fn () => 'foo');
        self::assertFalse($spec->isSatisfiedBy(new MockObject()));

        $spec = new CriteriaSpecification('privateProperty', 'foo', MockObject::class, fn () => 'foo');
        self::assertTrue($spec->isSatisfiedBy(new MockObject()));
    }
}
