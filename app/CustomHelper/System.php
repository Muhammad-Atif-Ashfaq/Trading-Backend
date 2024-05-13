<?php

if (!function_exists('tableToModel')) {
    function tableToModel($tableName)
    {
        // Remove "s" from the end of the table name if it's plural
        if (substr($tableName, -1) === 's') {
            $tableName = substr($tableName, 0, -1);
        }

        // Remove underscores and capitalize each word
        $modelName = str_replace('_', ' ', $tableName);
        $modelName = ucwords($modelName);
        $modelName = str_replace(' ', '', $modelName);

        // Convert the first character to uppercase
        $modelName = ucfirst($modelName);


        return 'App\\Models\\' . $modelName;
    }
}

if (!function_exists('skipValue0')) {
    function skipValue0(array $data)
    {
        return array_filter($data, function ($value) {
            return !empty($value);
        });
    }
}

if (!function_exists('prepareUpdateCols')) {
    function prepareUpdateCols(array $data, $model)
    {
        $fillableAttributes = app(tableToModel($model))->getFillable();
        $filteredData = [];
        foreach ($data as $key => $value) {
            // Check if the key exists in the fillable attributes array
            if (in_array($key, $fillableAttributes)) {
                // If yes, add the key-value pair to the filtered data array
                $filteredData[$key] = $value;
            }
        }
        return skipValue0($filteredData);
    }
}
if (!function_exists('calculateNights')) {
    function calculateNights($startDate, $endDate)
    {
        // Convert dates to DateTime objects
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);

        // Set the start time for each day to 11 PM
        $startDate->setTime(23, 0, 0);

        // Calculate the number of nights
        $nights = 0;

        while ($startDate < $endDate) {
            $nights++;

            // Move to the next day (24 hours)
            $startDate->add(new DateInterval('P1D'));

            // Set the time to 11 PM for the next day
            $startDate->setTime(23, 0, 0);
        }

        return $nights;
    }
}
if (!function_exists('calculateCalswap')) {
    function calculateCalswap($volume, $totalNights, $symbolSetting)
    {
        return $volume * $totalNights * ($symbolSetting ? (double)$symbolSetting->swap : 0);
    }
}


