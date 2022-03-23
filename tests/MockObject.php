<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification\Tests;

class MockObject
{
    public string $publicProperty = 'this is public';
    protected string $protectedProperty = 'this is protected';
    private string $privateProperty = 'this is private';

    public function publicMethod(): string
    {
        return 'this is a public method';
    }

    protected function protectedMethod(): string
    {
        return 'this is a protected method';
    }

    private function privateMethod(): string
    {
        return 'this is a private method';
    }
}
