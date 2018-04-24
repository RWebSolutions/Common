<?php
declare(strict_types=1);

namespace RWS\Common;

/**
 * @package RWSB\Common
 */
abstract class Enumerable
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
        $this->assertValid();
    }

    /**
     * @param string $value
     * @return Enumerable
     */
    public static function fromString(string $value): self
    {
        return new static($value);
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function assertValid(): void
    {
        $allowedValues = static::allowedValues();
        if (!in_array($this->value, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Expected one of: %s. Got: %s',
                    implode(', ', $allowedValues),
                    $this->value
                )
            );
        }
    }

    /**
     * @return string[]
     */
    abstract public static function allowedValues(): array;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}