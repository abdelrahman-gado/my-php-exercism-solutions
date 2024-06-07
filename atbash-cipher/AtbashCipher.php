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

function removePunctuations(string $text): string
{
    return preg_replace("/[\W]/u", '', $text);
}
 
function encodeCharacter(string $character): string 
{
    $difference = ord($character) - ord('a');
    return chr(ord('a') + (26 - $difference - 1));
}

function encode(string $text): string
{
    $encodedText = '';
    $text = removePunctuations(strtolower($text));
    $counter = 0;

    foreach (str_split($text) as $ch) {
        if ($counter === 5) {
            $counter = 0;
            $encodedText .= ' ';
        }

        if (is_numeric($ch)) {
            $encodedText .= $ch;
            $counter++;
            continue;
        }

        $encodedText .= encodeCharacter($ch);
        $counter++;
    }

    return $encodedText;
}
