<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

use PHPUnit\Framework\TestCase;

class GenericSpecificationTest extends TestCase
{
    public function testSupportedType(): void
    {
        $spec = new MockTrueSpecification(\DateTimeInterface::class);

        self::assertTrue($spec->isSatisfiedBy(new \DateTime()));
    }

    public function testUnsupportedTypeReturnFalse(): void
    {
        $spec = new MockTrueSpecification(\DateTimeInterface::class);

        self::assertFalse($spec->isSatisfiedBy(new \ArrayObject()));
    }

    public function testIncompatibleOperandRaiseError(): void
    {
        $left = new MockTrueSpecification(\DateTimeInterface::class);
        $right = new MockTrueSpecification(\ArrayObject::class);

        self::expectExceptionMessageMatches('/Given specification is not compatible with type/');
        $left->and($right);
    }
}
