<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LuhnAlgorithm implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $num = preg_replace('/\D/', '', $value);

        if (!strlen($num)) {
            $fail('validation.regex');
        }

        $sum = '';

        for ($i = strlen($num) - 1; $i >= 0; -- $i) {
            $sum .= $i & 1 ? $num[$i] : $num[$i] * 2;
        }

        if (array_sum(str_split($sum)) % 10 !== 0) {
            $fail('validation.regex');
        }
    }
}
