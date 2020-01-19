<?php

declare(strict_types=1);

namespace Badger\SharedSpace\ValueObject;

abstract class StringObject
{
    private string $value;

    protected function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    abstract function validate(string $value): void;

    public static function fromString(string $value)
    {
        return new static($value);
    }

    public function equals(StringObject $value): bool
    {
        return $value->value === $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
