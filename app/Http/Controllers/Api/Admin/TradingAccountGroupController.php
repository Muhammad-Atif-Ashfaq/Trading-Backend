<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use Illuminate\Http\Request;
use App\Models\TradingAccountGroup;

class TradingAccountGroupController extends Controller
{

    public $model;

    public function __construct()
    {
        $this->model = new TradingAccountGroup();
    }


    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $groups = $this->model::query();
            $groups = PaginationHelper::paginate(
                $groups,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($groups, 'All Groups');
        });
    }



    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $groups = $this->model::create([
                'name' => $request->name,
                'mass_trading_orders' => $request->mass_trading_orders,
                'mass_transaction_orders' => $request->mass_transaction_orders,
                'mass_leverage' => $request->mass_leverage,
                'mass_swap' => $request->mass_swap,
            ]);
            if ($groups) {
                return $this->sendResponse($groups, 'Group Store Successfully');
            }
        });
    }


    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $groups = $this->model::find($id);
            return $this->sendResponse($groups, 'Single Group');
        });
    }



    public function update(Request $request, string $id)
    {

        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $group = $this->model::find($id);
            $update = $group->update([
                'name' => $request->name ?? $group->name,
                'mass_trading_orders' => $request->mass_trading_orders ?? $group->mass_trading_orders,
                'mass_transaction_orders' => $request->mass_transaction_orders ?? $group->mass_transaction_orders,
                'mass_leverage' => $request->mass_leverage ?? $group->mass_leverage,
                'mass_swap' => $request->mass_swap ?? $group->mass_swap,
            ]);
            if ($update) {
                return $this->sendResponse($group, 'groups Update Successfully');
            }
        });
    }

    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $groups = $this->model::find($id)->delete();
            return $this->sendResponse($groups, 'Group Deleted');
        });
    }
}
