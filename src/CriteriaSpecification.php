<?php

declare (strict_types=1);

namespace MakinaCorpus\Specification;

/**
 * We start doing business with simple things, this class represent an instance
 * property value must be equal to.
 *
 * This remains agnostic from any framework, but it can serve the purpose, for
 * example, to implement a criteria based specification for a database query.
 */
class CriteriaSpecification extends CompositeSpecification
{
    private string $property;
    private /* mixed */ $value;
    private /* callable */ $accessor;

    public function __construct(string $property, $value, ?string $type = null, ?callable $accessor = null)
    {
        parent::__construct($type);

        $this->property = $property;
        $this->value = $value;

        $this->accessor = $accessor ?? fn (object $object, string $property) => ValueAccessor::getValueFrom($object, $property);
    }

    /**
     * Get property name.
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * Get property value.
     */
    public function getValue() /* : mixed */
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    protected function doIsSatisfiedBy(object $object): bool
    {
        return ($this->accessor)($object, $this->property) === $this->value;
    }
}
