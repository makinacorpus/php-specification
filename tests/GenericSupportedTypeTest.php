<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

use MakinaCorpus\Specification\Generic\GenericSupportedType;
use PHPUnit\Framework\TestCase;

/**
 * If type string is identical, types are compatible.
 *
 * If current type is an interface, other type must implement when a class or
 * extend when an interface current type in order to be compatible.
 *
 * If current type is a class, other type must extend this type to be supported.
 */
class GenericSupportedTypeTest extends TestCase
{
    public function testIdenticalClassesAreCompatible(): void
    {
        $reference = new GenericSupportedType('\\DateTime');
        $other = new GenericSupportedType('DateTime');

        self::assertTrue($reference->isCompatible($other));
    }

    public function testIdenticalInterfacesAreCompatible(): void
    {
        $reference = new GenericSupportedType('\\DateTimeInterface');
        $other = new GenericSupportedType('DateTimeInterface');

        self::assertTrue($reference->isCompatible($other));
    }

    public function testIdenticalStringsAreCompatible(): void
    {
        $reference = new GenericSupportedType('foo');
        $other = new GenericSupportedType('foo');

        self::assertTrue($reference->isCompatible($other));
    }

    public function testSublassIsCompatibleWithClass(): void
    {
        $reference = new GenericSupportedType(TestCase::class);
        $other = new GenericSupportedType(GenericSupportedTypeTest::class);

        self::assertTrue($reference->isCompatible($other));
        self::assertFalse($other->isCompatible($reference));
    }

    public function testImplementingClassCompatibleWithInterface(): void
    {
        $reference = new GenericSupportedType(\DateTimeInterface::class);
        $other = new GenericSupportedType(\DateTime::class);

        self::assertTrue($reference->isCompatible($other));
        self::assertFalse($other->isCompatible($reference));
    }

    public function testExtendingInterfaceIsCompatibleWithInterface(): void
    {
        $reference = new GenericSupportedType(\DateTimeInterface::class);
        $other = new GenericSupportedType(FooDateTime::class);

        self::assertTrue($reference->isCompatible($other));
        self::assertFalse($other->isCompatible($reference));
    }

    public function testNotSublassIsNotCompatibleWithClass(): void
    {
        $reference = new GenericSupportedType(\DateTime::class);
        $other = new GenericSupportedType(\Exception::class);

        self::assertFalse($reference->isCompatible($other));
        self::assertFalse($other->isCompatible($reference));
    }

    public function testNonImplementingClassNotCompatibleWithInterface(): void
    {
        $reference = new GenericSupportedType(\DateTimeInterface::class);
        $other = new GenericSupportedType(\Exception::class);

        self::assertFalse($reference->isCompatible($other));
        self::assertFalse($other->isCompatible($reference));
    }

    public function testNonExtendingInterfaceIsNotCompatibleWithInterface(): void
    {
        $reference = new GenericSupportedType(\DateTimeInterface::class);
        $other = new GenericSupportedType(\Throwable::class);

        self::assertFalse($reference->isCompatible($other));
        self::assertFalse($other->isCompatible($reference));
    }
}

interface FooDateTime extends \DateTimeInterface
{
}
