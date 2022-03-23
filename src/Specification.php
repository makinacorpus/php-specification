<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

interface Specification extends Generic
{
    /**
     * Given an object, is this specification satisfied.
     */
    public function isSatisfiedBy(object $object): bool;

    /**
     * And other specification.
     */
    public function and(Specification $other): Specification;

    /**
     * And not other specification.
     */
    public function andNot(Specification $other): Specification;

    /**
     * Or other specification.
     */
    public function or(Specification $other): Specification;

    /**
     * Or not other specification.
     */
    public function orNot(Specification $other): Specification;

    /**
     * Not specification.
     */
    public function not(): Specification;
}
