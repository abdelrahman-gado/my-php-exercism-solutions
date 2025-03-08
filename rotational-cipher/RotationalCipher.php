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

class RotationalCipher
{
    const MAX_ALPHA_CHARS = 26;
    const ALPHA_START_CHAR_IN_LOWERCASE = 'a';
    const ALPHA_START_CHAR_IN_UPPERCASE = 'A';

    public function rotate(string $text, int $shift): string
    {
        $rotatedText = '';
        $textLength = strlen($text);
        for ($i = 0; $i < $textLength; $i++) {
            $character = $text[$i];
            $rotatedText .= $this->rotateCharacter($character, $shift);
        }

        return $rotatedText;
    }

    private function isCapitalCharacter(string $character): bool
    {
        return $character === strtoupper($character);
    }

    private function rotateCharacter(string $character, int $shift): string
    {
        $alphaStartChar = $this->isCapitalCharacter($character) ? self::ALPHA_START_CHAR_IN_UPPERCASE : self::ALPHA_START_CHAR_IN_LOWERCASE;
        if (ctype_alpha($character)) {
            return chr(((ord($character) - ord($alphaStartChar) + $shift) % self::MAX_ALPHA_CHARS) + ord($alphaStartChar));
        } else {
            return $character;
        }
    }
}
