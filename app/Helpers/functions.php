<?php

require_once 'Filament/functions.php';
require_once 'Functions/errors.php';
require_once 'Functions/request.php';
require_once 'Functions/resource.php';

function convertArrayToIntegers($array): array
{
    return array_map(fn($value) => intval($value), $array);
}

function mb__ucfirst(string $text): string
{
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

function cal_days_in_current_month(): int
{
    $date = getdate();

    return cal_days_in_month(CAL_GREGORIAN, $date['mon'], $date['year']);
}

function cleanAndUniqueWords(string $str = ''): array
{
    if ($str == '') {
        return [];
    }

    $words = preg_split('/\P{L}+/u', $str, -1, PREG_SPLIT_NO_EMPTY);

    $filteredWords = array_filter($words, fn($word) => mb_strlen($word) > 2);

    return array_unique($filteredWords);
}

function array_filter_on_null(array $array): array
{
    return array_filter($array, fn($value) => $value != null);
}
