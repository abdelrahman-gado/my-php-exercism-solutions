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

function slices(string $digits, int $series): array
{
    $digitsLength = strlen($digits);
    if ($series > $digitsLength || $series <= 0) {
        throw new Exception('invalid series');
    }

    $seriesArr = [];
    for ($i = 0; $i <= $digitsLength - $series; $i++) {
        $seriesArr[] = substr($digits, $i, $series);
    }

    return $seriesArr;
}

// Another Solution:
/*
function slices(string $digits, int $series): array
{
    $digitsLength = strlen($digits);
    if ($series > $digitsLength || $series <= 0) {
        throw new Exception('invalid series');
    }

    $seriesCount = $digitsLength - $series + 1;
    $seriesArr = [];
    for ($i = 0; $i < $digitsLength; $i++) 
    {
        $digit = $digits[$i];
        $seriesArrLength = count($seriesArr);

        foreach ($seriesArr as &$seriesStr) {
            if (strlen($seriesStr) < $series)
                $seriesStr .= $digit;
        }

        if ($seriesArrLength < $seriesCount) {
            $seriesArr[] = $digit;
        }
    }

    return $seriesArr;
}
*/