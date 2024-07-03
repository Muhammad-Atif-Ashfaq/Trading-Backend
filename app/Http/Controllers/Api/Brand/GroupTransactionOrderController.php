<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Brand\GroupTransactionOrderRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Brand\GroupTransactionOrder\Create as GroupTradeOrderCreate;
use App\Http\Requests\Api\Brand\GroupTransactionOrder\Index as GroupTradeOrderIndex;
use App\Models\TransactionOrder;

class GroupTransactionOrderController extends Controller
{
    protected $groupTransactionOrderRepository;

    public function __construct(GroupTransactionOrderRepository $groupTransactionOrderRepository)
    {
        $this->groupTransactionOrderRepository = $groupTransactionOrderRepository;
    }

    public function index(GroupTradeOrderIndex $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $groupTransactionOrder = $this->groupTransactionOrderRepository->getAllGroupTransactionOrder($request);
            return $this->sendResponse($groupTransactionOrder, 'All GroupTransactionOrder');
        });
    }

    public function store(GroupTradeOrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->groupTransactionOrderRepository->createGroupTransactionOrder($request->validated());
            return $this->sendResponse($user, 'GroupTransactionOrder created successfully');
        });
    }

    public function show(TransactionOrder $transactionOrder)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($transactionOrder) {
            $groupTransactionOrder = $this->groupTransactionOrderRepository->findGroupTransactionOrderById($transactionOrder);
            return $this->sendResponse($groupTransactionOrder, 'Single GroupTransactionOrder');
        });
    }

    public function update(Request $request, TransactionOrder $transactionOrder)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($transactionOrder, $request) {
            $groupTransactionOrder = $this->groupTransactionOrderRepository->updateGroupTransactionOrder($request->all(), $transactionOrder);
            return $this->sendResponse($groupTransactionOrder, 'GroupTransactionOrder updated successfully');
        });
    }

    public function destroy(TransactionOrder $transactionOrder)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($transactionOrder) {
            $this->groupTransactionOrderRepository->deleteGroupTransactionOrder($transactionOrder);
            return $this->sendResponse([], 'GroupTransactionOrder deleted successfully');
        });
    }
}