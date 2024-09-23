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

function transpose(array $input): array
{
    $inputCount = count($input);
    $maxRowCount = getMaxRowCount($input);
    if ($inputCount == 1 && $maxRowCount == 0) {
        return [""];
    }

    $transposed = [];
    for ($i = 0; $i < $maxRowCount; $i++) {
        $row = '';
        for ($j = 0; $j < $inputCount; $j++) {
            $row .= $input[$j][$i] ?? ' ';
        }
        $transposed[] = $row;
    }

    $transposed[count($transposed) - 1] = rtrim($transposed[count($transposed) - 1]);
    return $transposed;
}

function getMaxRowCount(array $input): int
{
    $maxRowCount = PHP_INT_MIN;
    foreach ($input as $row) {
        $rowLength = strlen($row);
        $maxRowCount = $rowLength > $maxRowCount ? $rowLength : $maxRowCount;
    }

    return $maxRowCount;
}
