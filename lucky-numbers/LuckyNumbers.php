<?php

class LuckyNumbers
{
    public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
    {
        $number1 = (int) implode('', $digitsOfNumber1);
        $number2 = (int) implode('', $digitsOfNumber2);
        return $number1 + $number2;
    }

    public function isPalindrome(int $number): bool
    {
        $strNumber = (string) $number;
        return $strNumber === strrev($strNumber);
    }

    public function validate(string $input): string
    {
        if (strlen($input) == 0) {
            return 'Required field';
        }

        $num = (int) $input;
        if ($num <= 0) {
            return 'Must be a whole number larger than 0';
        }

        return '';
    }
}
