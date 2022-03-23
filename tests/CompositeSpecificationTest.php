<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

use PHPUnit\Framework\TestCase;

class CompositeSpecificationTest extends TestCase
{
    public function testAnd(): void
    {
        // true, true => true
        $left = new MockTrueSpecification();
        $right = new MockTrueSpecification();
        self::assertTrue($left->and($right)->isSatisfiedBy(new \stdClass()));

        // true, false => false
        $left = new MockTrueSpecification();
        $right = new MockFalseSpecification();
        self::assertFalse($left->and($right)->isSatisfiedBy(new \stdClass()));

        // false, true => false
        $left = new MockFalseSpecification();
        $right = new MockTrueSpecification();
        self::assertFalse($left->and($right)->isSatisfiedBy(new \stdClass()));

        // false, false => false
        $left = new MockFalseSpecification();
        $right = new MockFalseSpecification();
        self::assertFalse($left->and($right)->isSatisfiedBy(new \stdClass()));
    }

    public function testAndNot(): void
    {
        // true, true => false
        $left = new MockTrueSpecification();
        $right = new MockTrueSpecification();
        self::assertFalse($left->andNot($right)->isSatisfiedBy(new \stdClass()));

        // true, false => true
        $left = new MockTrueSpecification();
        $right = new MockFalseSpecification();
        self::assertTrue($left->andNot($right)->isSatisfiedBy(new \stdClass()));

        // false, true => false
        $left = new MockFalseSpecification();
        $right = new MockTrueSpecification();
        self::assertFalse($left->andNot($right)->isSatisfiedBy(new \stdClass()));

        // false, false => false
        $left = new MockFalseSpecification();
        $right = new MockFalseSpecification();
        self::assertFalse($left->andNot($right)->isSatisfiedBy(new \stdClass()));
    }

    public function testOr(): void
    {
        // true, true => true
        $left = new MockTrueSpecification();
        $right = new MockTrueSpecification();
        self::assertTrue($left->or($right)->isSatisfiedBy(new \stdClass()));

        // true, false => true
        $left = new MockTrueSpecification();
        $right = new MockFalseSpecification();
        self::assertTrue($left->or($right)->isSatisfiedBy(new \stdClass()));

        // false, true => true
        $left = new MockFalseSpecification();
        $right = new MockTrueSpecification();
        self::assertTrue($left->or($right)->isSatisfiedBy(new \stdClass()));

        // false, false => false
        $left = new MockFalseSpecification();
        $right = new MockFalseSpecification();
        self::assertFalse($left->or($right)->isSatisfiedBy(new \stdClass()));
    }

    public function testOrNot(): void
    {
        // true, true => true
        $left = new MockTrueSpecification();
        $right = new MockTrueSpecification();
        self::assertTrue($left->orNot($right)->isSatisfiedBy(new \stdClass()));

        // true, false => true
        $left = new MockTrueSpecification();
        $right = new MockFalseSpecification();
        self::assertTrue($left->orNot($right)->isSatisfiedBy(new \stdClass()));

        // false, true => false
        $left = new MockFalseSpecification();
        $right = new MockTrueSpecification();
        self::assertFalse($left->orNot($right)->isSatisfiedBy(new \stdClass()));

        // false, false => true
        $left = new MockFalseSpecification();
        $right = new MockFalseSpecification();
        self::assertTrue($left->orNot($right)->isSatisfiedBy(new \stdClass()));
    }

    public function testNot(): void
    {
        // true => false
        $left = new MockTrueSpecification();
        self::assertFalse($left->not()->isSatisfiedBy(new \stdClass()));

        // false => true
        $left = new MockFalseSpecification();
        self::assertTrue($left->not()->isSatisfiedBy(new \stdClass()));
    }
}
