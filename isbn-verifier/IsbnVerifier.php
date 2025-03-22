<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class IsbnVerifier
{
    private const ISBN_LENGTH = 10;

    public function isValid(string $isbn): bool
    {
        $isbnWithOutDashes = str_replace('-', '', $isbn);
        if (strlen($isbnWithOutDashes) !== self::ISBN_LENGTH) {
            return false;
        }

        return $this->calculateCheckDigit($isbnWithOutDashes) === 0;
    }

    private function calculateCheckDigit(string $isbn): int
    {
        $result = 0;
        for ($i = 10; $i >= 1; $i--) {
            $digit = $isbn[10 - $i];
            if ($i === 1 && $digit === 'X') {
                $digit = 10;
            } elseif (!is_numeric($digit)) {
                return -1;
            }
            $result += $i * $digit;
        }

        return $result % (self::ISBN_LENGTH + 1);
    }
}