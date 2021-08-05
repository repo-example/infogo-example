<?php

namespace App\Utils;

class Str
{
    public static function reverse(string $string): string
    {
        $length   = mb_strlen($string);
        $reversed = '';
        while ($length-- > 0) {
            $reversed .= mb_substr($string, $length, 1);
        }
        return $reversed;
    }
}
