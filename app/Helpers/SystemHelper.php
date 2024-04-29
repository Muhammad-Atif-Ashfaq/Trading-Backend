<?php


namespace App\Helpers;


class SystemHelper extends Helper
{
    public static function tableToModel($tableName) {
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

    public static function skipValue0(array $data)
    {
        return array_filter($data, function ($value) {
            return  !empty($value);
        });
    }

}
