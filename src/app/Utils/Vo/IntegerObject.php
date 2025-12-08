<?php

namespace App\Utils\VO;

class IntegerObject {
    private int $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }

    public function toInt(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void {
        $this->value = $value;
    }

    public function add(int $number): IntegerObject {
        return new IntegerObject($this->value + $number);
    }

    public function subtract(int $number): IntegerObject {
        return new IntegerObject($this->value - $number);
    }

    public function multiply(int $number): IntegerObject {
        return new IntegerObject($this->value * $number);
    }

    public function divide(int $number): IntegerObject {
        if ($number === 0) {
            throw new \InvalidArgumentException('Cannot divide by zero.');
        }
        return new IntegerObject(intdiv($this->value, $number));
    }
}
