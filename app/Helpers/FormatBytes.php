<?php

namespace App\Helpers;

class FormatBytes
{

    static public function formatBytes($bytes, $precision = 2): string
    {
        $unit = ["B", "KB", "MB", "GB"];
        $exp = floor(log($bytes, 1024)) | 0;
        return round($bytes / (pow(1024, $exp)), $precision) . $unit[$exp];
    }
}
