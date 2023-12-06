<?php

declare(strict_types=1);

namespace BeerFinder\Domain\ValueObject;

use BeerFinder\Domain\ValueObject\Interface\ValueObjectInterface;
use Respect\Validation\Validator as v;
use Exception;

readonly class Id implements ValueObjectInterface
{
    /**
     * @param int|string $value
     * @throws Exception
     */
    public function __construct(
        protected int|string $value
    ) {
        $this->validate($value);
    }

    /**
     * @param int|string $value
     * @return void
     * @throws Exception
     */
    protected function validate(int|string $value): void
    {
        if ($this->isValidId($value)) {
            return;
        }
        if (false === $this->isValidV4UUID((string)$value)) {
            throw new Exception('Id should be a valid UUID');
        }
    }

    /**
     * @return int|string
     */
    public function getValue(): int|string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return bool
     */
    protected function isValidV4UUID(string $value): bool
    {
        $validator = v::uuid(4);
        return $validator->validate($value);
    }

    /**
     * @param int|string $value
     * @return bool
     * @throws Exception
     */
    private function isValidId(int|string $value): bool
    {
        if (is_string($value)) {
            return false;
        }
        if ($value < 1) {
            throw new \Exception('Invalid Id number');
        }
        return true;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
