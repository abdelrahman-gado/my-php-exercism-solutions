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

const FIRST_CHAR = 'A';

function diamond(string $letter): array
{
    if ($letter === FIRST_CHAR) {
        return [$letter];
    }

    $targetCode = ord($letter);
    $firstHalf = getFirstHalf($targetCode);
    $currentLetterLine = getTargetLetterLine($targetCode);
    $lastHalf = getLastHalf($firstHalf);

    return [
        ...$firstHalf,
        $currentLetterLine,
        ...$lastHalf
    ];
}

function getFirstHalf(int $targetCode): array
{
    $triangle = [];
    $firstLetterCode = ord(FIRST_CHAR);
    for ($code = $firstLetterCode; $code < $targetCode; $code++) {
        $triangle[] = getLine($code, $targetCode);
    }

    return $triangle;
}

function getLastHalf(array $items): array
{
    return array_reverse($items);
}

function getTargetLetterLine(int $targetCode): string
{
    $max = ($targetCode - ord(FIRST_CHAR)) + ($targetCode - ord(FIRST_CHAR)) - 1;
    return chr($targetCode) . str_repeat(' ', $max) . chr($targetCode);
}

function getLine(int $currentCode, int $targetCode)
{
    $difference = $targetCode - $currentCode;
    $max = ($targetCode - ord(FIRST_CHAR)) + ($targetCode - ord(FIRST_CHAR)) - 1;
    if (chr($currentCode) === FIRST_CHAR) {
        return str_repeat(' ', $difference) . FIRST_CHAR . str_repeat(' ', $difference);
    }

    return str_repeat(' ', $difference) . chr($currentCode) . str_repeat(' ', $max - ($difference) - ($difference)) . chr($currentCode) . str_repeat(' ', $difference);
}
