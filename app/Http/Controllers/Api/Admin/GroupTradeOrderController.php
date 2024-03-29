<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\GroupTradeOrderRepository;
use App\Http\Requests\Api\Admin\GroupTradeOrders\Create as GroupTradeOrderCreate;
use Illuminate\Http\Request;


class GroupTradeOrderController extends Controller
{
    protected $groupTradeOrderRepository;

    public function __construct(GroupTradeOrderRepository $groupTradeOrderRepository)
    {
        $this->groupTradeOrderRepository = $groupTradeOrderRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $groupTradeOrders = $this->groupTradeOrderRepository->getAllGroupTradeOrders($request);
            return $this->sendResponse($groupTradeOrders, 'All GroupTradeOrders');
        });
    }

    public function store(GroupTradeOrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->groupTradeOrderRepository->createGroupTradeOrder($request->validated());
            return $this->sendResponse($user, 'GroupTradeOrder created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $groupTradeOrder = $this->groupTradeOrderRepository->findGroupTradeOrderById($id);
            return $this->sendResponse($groupTradeOrder, 'Single GroupTradeOrder');
        });
    }

    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $groupTradeOrder = $this->groupTradeOrderRepository->updateGroupTradeOrder($request, $id);
            return $this->sendResponse($groupTradeOrder, 'GroupTradeOrder updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->groupTradeOrderRepository->deleteGroupTradeOrder($id);
            return $this->sendResponse([], 'GroupTradeOrder deleted successfully');
        });
    }
}

