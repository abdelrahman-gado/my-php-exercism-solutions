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
        $sanitized = preg_replace('/[^A-Za-z]/', '', $str);
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
        return $sanitized == '' && $trimmed == '';
    }

    private function isQuestionWithYelling(string $sanitized, string $trimmed): bool
    {
        return $this->isStringUpper($sanitized) && $this->endsWithQuestion($trimmed) && !$this->isSayingNothing($trimmed, $sanitized);
    }

    private function isYellingAtHim(string $sanitized, string $trimmed): bool
    {
        return $this->isStringUpper($sanitized) && !$this->endsWithQuestion($trimmed) && !$this->isSayingNothing($trimmed, $sanitized);
    }

    private function isAQuestion(string $sanitized, string $trimmed): bool
    {
        return !$this->isStringUpper($sanitized) && $this->endsWithQuestion($trimmed) && !$this->isSayingNothing($trimmed, $sanitized);
    }

    private function isStringUpper(string $str): bool
    {
        return ctype_upper($str);
    }

    private function endsWithExclamation(string $str): bool
    {
        return str_ends_with($str, '!');
    }

    private function endsWithQuestion(string $str): bool
    {
        return str_ends_with($str, '?');
    }
}
