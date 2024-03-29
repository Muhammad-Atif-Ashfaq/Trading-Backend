<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\GroupTransactionOrderRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Admin\GroupTransactionOrder\Create as GroupTradeOrderCreate; 

class GroupTransactionOrderController extends Controller
{
    protected $groupTransactionOrderRepository;

    public function __construct(GroupTransactionOrderRepository $groupTransactionOrderRepository)
    {
        $this->groupTransactionOrderRepository = $groupTransactionOrderRepository;
    }
    
    public function index(Request $request)
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

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $groupTransactionOrder = $this->groupTransactionOrderRepository->findGroupTransactionOrderById($id);
            return $this->sendResponse($groupTransactionOrder, 'Single GroupTransactionOrder');
        });
    }

    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $groupTransactionOrder = $this->groupTransactionOrderRepository->updateGroupTransactionOrder($request, $id);
            return $this->sendResponse($groupTransactionOrder, 'GroupTransactionOrder updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->groupTransactionOrderRepository->deleteGroupTransactionOrder($id);
            return $this->sendResponse([], 'GroupTransactionOrder deleted successfully');
        });
    }
}
