<?php

namespace App\Helpers;

class ConvertToDate
{
    static public function toDate(string $date, string $format = "d/m/Y"): string
    {
        return date($format, strtotime($date));
    }

    static public function toDateTime(string $date, string $format = "d/m/Y H:i:s"): string
    {
        return date($format, strtotime($date));
    }

    static public function toTime(string $date, string $format = "H:i:s"): string
    {
        return date($format, strtotime($date));
    }
}
