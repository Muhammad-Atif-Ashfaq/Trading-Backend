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
