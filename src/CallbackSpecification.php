<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

/**
 * Mostly used for unit tests. You should not use this.
 *
 * Users are encouraged in writing business oriented specifications by extending
 * the CompositeSpecification class, which take place in a domain bound DSL.
 */
final class CallbackSpecification extends CompositeSpecification
{
    private /* callable */ $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return ($this->callback)($object);
    }
}
