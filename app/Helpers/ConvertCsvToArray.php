<?php

namespace App\Helpers;


use Illuminate\Http\Request;

class ConvertCsvToArray
{

    static public function handle(Request $request, string $requestFileName): array
    {
        $csv = $request->{$requestFileName};

        if (!$csv) return [];

        $fileContents = file($csv->getPathname());

        $data = [];
        $col = [];
        $row = [];

        foreach ($fileContents as $key => $value) {
            $row = str_getcsv($value)[0];
            $row =  explode(";", $row);

            if ($key == 0) {
                foreach ($row as $index => $val) {
                    $col[$index] = $val;
                }
            } else {
                $dataRow = [];
                foreach ($row as $index => $val) {
                    $dataRow[$col[$index]] = $val;
                }
                $data[$key] = $dataRow;
            }
        }

        return $data;
    }
}
