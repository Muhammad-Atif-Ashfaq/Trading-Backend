<?php

namespace App\Repositories\Api\Admin;

use App\Helpers\SystemHelper;
use App\Interfaces\Api\Admin\MassActionInterface;
use Illuminate\Support\Facades\DB;

class MassActionRepository implements MassActionInterface
{

    public function massEdit(array $data,array $values)
    {
        $tableName = new (SystemHelper::tableToModel($data['table_name']))();
        $tableIds = $data['table_ids'] ?? [];

        if (empty($tableIds)) {
            // If table_ids is empty, update all rows from the table
            return $tableName->update($values);
        } else {
            // If table_ids is not empty, update rows with the specified ids
            return $tableName->whereIn('id', $tableIds)->update($values);
        }
    }


    public function massDelete(array $data)
    {
        $tableName =  new (SystemHelper::tableToModel($data['table_name']))();
        $tableIds = $data['table_ids'] ?? [];

        if (empty($tableIds)) {
            // If table_ids is empty, delete all rows from the table
            return $tableName->delete();
        } else {
            // If table_ids is not empty, delete rows with the specified ids
            return $tableName->whereIn('id', $tableIds)->delete();
        }
    }

}
