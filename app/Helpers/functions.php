<?php

require_once 'Filament/functions.php';

function convertArrayToIntegers($array): array
{
    return array_map(fn($value) => intval($value), $array);
}

function mb_ucfirst(string $text): string
{
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}
