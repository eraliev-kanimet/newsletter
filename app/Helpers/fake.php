<?php

function fakeContent(): string
{
    $html = fakeH2() . '<br>' . fakeParagraph();

    $html .= fakeH2() . '<br>' . fakeList() . fakeParagraph();

    return $html;
}

function fakeH2(int $number = 5): string
{
    return '<h2>' . fake()->sentence($number) . '</h2>';
}

function fakeParagraph(int $number = 6): string
{
    return '<p>' . fake()->paragraph($number) . '</p>';
}

function fakeList(int $min = 2, int $max = 4, int $number = 4, string $type = 'ul'): string
{
    $html = "<$type>";

    for ($i = 1; $i <= rand($min, $max); $i++) {
        $html .= '<li>' . trim(fake()->sentence($number), '.') . ';</li>';
    }

    $html .= "</$type>";

    return $html;
}
