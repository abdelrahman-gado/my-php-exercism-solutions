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

function encode(string $input): string
{
    $inputLength = strlen($input);
    if ($inputLength <= 0) {
        return '';
    }

    $previous = $input[0];
    $encodedArray = [];

    $i = 1;
    $characterCount = 1;
    while ($i < $inputLength) {
        if ($input[$i] === $previous) {
            $characterCount++;
        } else {
            if ($characterCount === 1) {
                array_push($encodedArray, $previous);
            } else {
                array_push($encodedArray, $characterCount, $previous);
            }

            $previous = $input[$i];
            $characterCount = 1;
        }

        $i++;
    }

    if ($characterCount === 1) {
        array_push($encodedArray, $previous);
    } else {
        array_push($encodedArray, $characterCount, $previous);
    }

    return implode('', $encodedArray);
}

function decode(string $input): string
{
    $inputLength = strlen($input);
    if ($inputLength <= 0) {
        return '';
    }

    $decoded = '';

    $i = 0;
    $count = '';
    while ($i < $inputLength) {
        if (ctype_digit($input[$i])) {
            $count .= $input[$i];
        } else {
            $decoded .= str_repeat($input[$i], (int) $count ?: 1);
            $count = '';
        }

        $i++;
    }

    return $decoded;
}
