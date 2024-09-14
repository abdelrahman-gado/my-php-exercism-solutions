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

class Bob
{
    public function respondTo(string $str): string
    {
        $strLength = strlen($str);
        $sanitized = $this->sanitizeStr($str, $strLength);
        $trimmed = trim($str);

        return match(true) {
            $this->isAQuestion($sanitized, $trimmed) => 'Sure.',
            $this->isYellingAtHim($sanitized, $trimmed) => 'Whoa, chill out!',
            $this->isQuestionWithYelling($sanitized, $trimmed) => "Calm down, I know what I'm doing!",
            $this->isSayingNothing($sanitized, $trimmed) => 'Fine. Be that way!',
            default => 'Whatever.'
        };
    }

    private function isSayingNothing(string $sanitized, string $trimmed): bool
    {
        return $this->isEmpty($sanitized, $trimmed);
    }

    private function isQuestionWithYelling(string $sanitized, string $trimmed): bool
    {
        return $this->isStringUpper($sanitized) && $this->isEndsWithQuestion($trimmed) && !$this->isEmpty($trimmed, $sanitized);
    }

    private function isYellingAtHim(string $sanitized, string $trimmed): bool
    {
        return $this->isStringUpper($sanitized) && !$this->isEndsWithQuestion($trimmed) && !$this->isEmpty($trimmed, $sanitized);
    }

    private function isAQuestion(string $sanitized, string $trimmed): bool
    {
        return !$this->isStringUpper($sanitized) && $this->isEndsWithQuestion($trimmed) && !$this->isEmpty($trimmed, $sanitized);
    }

    private function sanitizeStr(string $str, int $strLength): string
    {
        $sanitized = '';
        for ($i = 0; $i < $strLength; $i++) {
            if (ctype_alpha($str[$i])) {
                $sanitized .= $str[$i];
            }
        }

        return $sanitized;
    }

    private function isStringUpper(string $str): bool
    {
        return ctype_upper($str);
    }

    private function isEndsWithExclamation(string $str): bool
    {
        return str_ends_with($str, '!');
    }

    private function isEndsWithQuestion(string $str): bool
    {
        return str_ends_with($str, '?');
    }

    private function isEmpty(string $trimmed, string $sanitized): bool
    {
        return $sanitized == '' && $trimmed == '';
    }
}
