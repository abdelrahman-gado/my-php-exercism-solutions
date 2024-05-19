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

function acronym(string $text): string
{
    $words = explode(' ', $text);
    if (count($words) == 1) {
        return '';
    }

    if (str_ends_with($words[0], ':')) {
        return mb_strtoupper(substr($words[0], 0, -1));
    }

    $acronymStr = '';
    foreach ($words as $word) {
        $acronymStr .= mb_strtoupper($word[0]);

        if (preg_match('/[A-Za-z]+([A-Z])[A-Za-z]+/', $word, $matches)) {
            $acronymStr .= mb_strtoupper(implode('', array_slice($matches, 1)));
        }

        if (preg_match('/[a-z]-([a-z])/', $word, $matches)) {
            $acronymStr .= mb_strtoupper(implode('', array_slice($matches, 1)));
        }
    }

    return $acronymStr;
}

//var_dump(acronym('Portable Network Graphics'));
//var_dump(acronym('Ruby on Rails'));
//var_dump(acronym('HyperText Markup Language'));
//var_dump(acronym('PHP: Hypertext Preprocessor'));
//var_dump(acronym('Complementary metal-oxide semiconductor'));
//var_dump(acronym('Специализированная процессорная часть'));
