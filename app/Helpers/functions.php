<?php

require_once 'Filament/functions.php';
require_once 'errors.php';

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

    return array_unique(array_map('trim', explode(' ', $str)));
}
