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

class Sublist
{
    public function compare(array $listOne, array $listTwo): string
    {
        return match(true) {
            $this->isEqual($listOne, $listTwo) => 'EQUAL',
            $this->isSuperList($listOne, $listTwo) => 'SUPERLIST',
            $this->isSubList($listOne, $listTwo) => 'SUBLIST',
            default => 'UNEQUAL',
        };
    }

    private function isEqual(array $listOne, $listTwo): bool
    {
        return $listOne === $listTwo;
    }

    private function isSuperList(array $listOne, array $listTwo): bool
    {
        $diff =  array_diff($listTwo, $listOne) === [];
        return $diff && $this->isContiguousLists($listOne, $listTwo);
    }

    private function isSubList(array $listOne, array $listTwo): bool
    {
        $diff = array_diff($listOne, $listTwo) === [];
        return $diff && $this->isContiguousLists($listTwo, $listOne);
    }

    private function isContiguousLists(array $bigArray, array $smallArray): bool
    {
        $bigArrayLength = count($bigArray);
        $smallArrayLength = count($smallArray);
        if ($smallArrayLength === 0) {
            return true;
        }

        for ($i = 0; $i <= $bigArrayLength - $smallArrayLength; $i++) {
            if (array_slice($bigArray, $i, $smallArrayLength) === $smallArray) {
                return true;
            }
        }

        return false;
    }
}
