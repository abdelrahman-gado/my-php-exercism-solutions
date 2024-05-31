<?php

function language_list(...$languages): array
{
    return $languages;
}

function add_to_language_list(array $languageList, string $newLanguage): array
{
    $languageList[] = $newLanguage;
    return $languageList;
}

function current_language(array $languageList): string
{
    return $languageList[0];
}

function language_list_length(array $languageList): int
{
    return count($languageList);
}

function prune_language_list(array $languageList): array
{
    array_shift($languageList);
    return $languageList;
}