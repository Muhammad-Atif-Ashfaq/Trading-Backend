<?php

namespace App\Repositories\Api\Admin;

use App\Enums\OrderTypeEnum;
use App\Interfaces\Api\Admin\MassActionInterface;
use App\Models\SymbelSetting;
use App\Models\TradeOrder;
use App\Models\TradingAccount;
use App\Services\GenerateFilesService;
use Illuminate\Support\Facades\DB;


class MassActionRepository implements MassActionInterface
{

    public function massEdit(array $data, array $values)
    {
        // Instantiate the model based on the table name provided in the data array
        $model = new (tableToModel($data['table_name']))();

        // Get the table IDs from the data array, default to an empty array if not provided
        $tableIds = $data['table_ids'] ?? [];

        // Determine the column name to filter by, defaulting to 'id' if not provided
        $columnName = $data['column_name'] ?? 'id';

        if (empty($tableIds)) {
            // If no specific IDs are provided, update all rows in the table
            $model->whereNotNull($columnName)->update($values);

            // Return all rows after update
            return $model->get();
        } else {
            // If specific IDs are provided, update only the rows with those IDs
            $model->whereNotNull($columnName)->whereIn($columnName, $tableIds)->update($values);

            // Return the updated rows
            return $model->whereIn($columnName, $tableIds)->get();
        }
    }



    public function massDelete(array $data)
    {
        $modelName = (tableToModel($data['table_name']));
        $model = new $modelName();
        $tableIds = $data['table_ids'] ?? [];
        $columnName = $data['column_name'] ?? 'id';

        if (empty($tableIds)) {
            $items = $model->whereNotNull($columnName);
        } else {
            $items = $model->whereNotNull($columnName)->whereIn($columnName, $tableIds);
        }
        if ($data['table_name'] == 'symbel_groups') {
            $items = $model->where('id','!=',1);
        }

        if (method_exists($modelName, 'onDelete')) {
            $modelName::onDelete($items);
        }

        if ($data['table_name'] != 'symbel_groups') {
            return $items->delete();
        }
        return 0;

    }

    public function massImport(array $data)
    {
        $model = new (tableToModel($data['table_name']))();
        $rows = $data['rows'];
        $mergeColumns = $data['marge_col']; // Assuming this is an array of column names
        $skipOrMerge = $data['skip'];

        DB::transaction(function () use ($model, $rows, $mergeColumns, $skipOrMerge) {
            foreach ($rows as $row) {
                if ($skipOrMerge === 'skip') {
                    $model->create($row);
                } elseif ($skipOrMerge === 'marge') {
                    $criteria = array_intersect_key($row, array_flip($mergeColumns));
                    $model->updateOrCreate($criteria, $row);
                }
            }
        });

        return true;
    }

    public function massExport(array $data)
    {
        $modelName = (tableToModel($data['table_name']));
        $model = new $modelName();
        $delimiter = $data['delimiter'];
        $tableIds = $data['table_ids'] ?? [];
        $columnName = $data['column_name'] ?? 'id';
        $exportColumns = $data['export_columns'] ?? 'id';

        if (empty($tableIds)) {
            $results = $model::select($exportColumns)
                ->whereNotNull($columnName)
                ->groupBy($columnName)->get();
        }else{
            $results = $model::select($exportColumns)
                ->whereNotNull($columnName)
                ->whereIn($columnName, $tableIds)
                ->groupBy($columnName)->get();
        }

        $url = GenerateFilesService::exportToCsv(prepareExportData($model,$results),$delimiter,$data['table_name'].'.csv');

        return ['url'=>$url];
    }


    public function massCloseOrders(array $ids)
    {
        // Fetch all trade orders with the given IDs
        $tradeOrders = TradeOrder::whereIn('id',$ids)->get();

        // Iterate through each trade order and update it
        foreach ($tradeOrders as $tradeOrder) {
            $symbol_setting = SymbelSetting::where('feed_fetch_name',$tradeOrder->symbol)->first();
            $currentPrice = $tradeOrder->getCurrentPrice($symbol_setting);
            $profit = $tradeOrder->calculateProfitLoss($currentPrice,$tradeOrder->open_price);

            $tradeOrder->profit = $profit;
            $tradeOrder->close_price = $currentPrice;
            $tradeOrder->order_type = OrderTypeEnum::CLOSE;
            $tradeOrder->close_time = now();
            $tradeOrder->save();

            // Update trading account balance based on profit
            $trading_account = TradingAccount::find($tradeOrder->trading_account_id);
            $returnBalance = (double)$trading_account->balance + (double)$profit ?? 0;
            $returnBalance -= ((double)$symbol_setting->commission * (double)$tradeOrder->valume);
            $calswap = calculateCalswap((double)$tradeOrder->valume, calculateNights($tradeOrder->created_at, now()), $symbol_setting);
            $newBalance = max($returnBalance - (double)$calswap, 0);
            $trading_account->balance = (string)$newBalance;
            $trading_account->save();

        }

        return $tradeOrders;

    }

}
