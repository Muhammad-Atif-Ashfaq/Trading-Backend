<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TradingAccount;
use App\Models\Brand;

class GenerateFilesService extends Service
{
    public static function exportToCsv($rows, $delimiter = ',', $filename = 'exported_data.csv')
    {
        $filePath = public_path($filename);
        $file = fopen($filePath, 'w');

        if (!empty($rows)) {
            // Add the header row
            fputcsv($file, array_keys($rows[0]), $delimiter);

            // Add the data rows
            foreach ($rows as $row) {
                $flattenedRow = self::flattenArray($row);
                fputcsv($file, $flattenedRow, $delimiter);
            }
        }

        fclose($file);

        return url('/csv/' . $filename);
    }

    private static function flattenArray(array $array)
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                // Check if 'name' key exists and use its value, otherwise an empty string
                return isset($value['name']) ? $value['name'] : '';
            } else if (is_object($value)) {
                // Check if 'name' property exists and use its value, otherwise an empty string
                return isset($value->name) ? $value->name : '';
            } else {
                return $value;
            }
        }, $array);
    }
}
