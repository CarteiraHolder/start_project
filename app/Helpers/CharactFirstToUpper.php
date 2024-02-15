<?php

namespace App\Helpers;

class CharactFirstToUpper
{

    static public function ucFirstAll(string $string): string
    {
        $explodeString = explode(" ", $string);

        $string = '';
        foreach ($explodeString as $key => $value) {
            $string .= ucfirst(strtolower($value)) . " ";
        }

        return trim($string);
    }
}
