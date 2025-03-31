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

function findFewestCoins(array $coins, int $amount): array
{
    if ($amount === 0) {
        return [];
    }

    if ($amount < 0) {
        throw new InvalidArgumentException("Cannot make change for negative value");
    }

    if (min($coins) > $amount) {
        throw new InvalidArgumentException("No coins small enough to make change");
    }

    $d = array_fill(0, $amount + 1, $amount + 1);
    $d[0] = 0;
    for ($i = 1; $i <= $amount; $i++) {
        foreach ($coins as $c) {
            if ($i - $c >= 0) {
                $d[$i] = min($d[$i], $d[$i - $c] + 1);
            }
        }
    }

    $changes = [];
    find($amount, [], $d, $coins, $changes, 0);
    if (count($changes) == 0) {
        throw new InvalidArgumentException("No combination can add up to target");
    }
    return $changes[0];
}

function find($n, $result, $d, $coins, &$changes, $index)
{
    if ($n == 0) {
        array_push($changes, $result);
        return;
    }

    for ($i = $index; $i < count($coins); $i++) {
        if (($n - $coins[$i] >= 0) && ($d[$n] == ($d[$n - $coins[$i]] + 1))) {
            array_push($result, $coins[$i]);
            find($n - $coins[$i], $result, $d, $coins, $changes, $i);
        }
    }
}