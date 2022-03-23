<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

use MakinaCorpus\Specification\ValueAccessor;
use PHPUnit\Framework\TestCase;

class ValueAccessorTest extends TestCase
{
    public function testPublicProperty(): void
    {
        $object = new MockObject();

        self::assertSame('this is public', ValueAccessor::getValueFrom($object, 'publicProperty'));
    }

    public function testProtectedProperty(): void
    {
        $object = new MockObject();

        self::assertSame('this is protected', ValueAccessor::getValueFrom($object, 'protectedProperty'));
    }

    public function testPrivateProperty(): void
    {
        $object = new MockObject();

        self::assertSame('this is private', ValueAccessor::getValueFrom($object, 'privateProperty'));
    }

    public function testPublicMethod(): void
    {
        $object = new MockObject();

        self::assertSame('this is a public method', ValueAccessor::getValueFrom($object, 'publicMethod'));
    }

    public function testProtectedMethod(): void
    {
        $object = new MockObject();

        self::assertSame('this is a protected method', ValueAccessor::getValueFrom($object, 'protectedMethod'));
    }

    public function testPrivateMethod(): void
    {
        $object = new MockObject();

        self::assertSame('this is a private method', ValueAccessor::getValueFrom($object, 'privateMethod'));
    }

    public function testNonExisting(): void
    {
        $object = new MockObject();

        self::assertNull(ValueAccessor::getValueFrom($object, 'nonExistingAnything'));
    }
}
