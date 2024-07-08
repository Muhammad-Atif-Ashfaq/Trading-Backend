<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ExceptionHandlerHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\TransactionOrders\Create as TransactionOrderCreate;
use App\Http\Requests\Api\Admin\TransactionOrders\Index as TransactionOrderIndex;
use App\Http\Requests\Api\Admin\TransactionOrders\Update as TransactionOrderUpdate;
use App\Repositories\Api\Admin\TransactionOrderRepository;

class TransactionOrderController extends Controller
{
    protected $transactionOrderRepository;

    public function __construct(TransactionOrderRepository $transactionOrderRepository)
    {
        $this->transactionOrderRepository = $transactionOrderRepository;
    }

    // TODO: Retrieves all transaction orders.
    public function index(TransactionOrderIndex $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $transactionOrders = $this->transactionOrderRepository->getAllTransactionOrders($request);

            return $this->sendResponse($transactionOrders, 'All TransactionOrders');
        });
    }

    // TODO: Stores a new transaction order.
    public function store(TransactionOrderCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->transactionOrderRepository->createTransactionOrder($request->validated());

            return $this->sendResponse($user, 'TransactionOrder created successfully');
        });
    }

    // TODO: Retrieves a single transaction order by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $transactionOrder = $this->transactionOrderRepository->findTransactionOrderById($id);

            return $this->sendResponse($transactionOrder, 'Single TransactionOrder');
        });
    }

    // TODO: Updates a transaction order.
    public function update(TransactionOrderUpdate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $transactionOrder = $this->transactionOrderRepository->updateTransactionOrder($request->validated(), $id);

            return $this->sendResponse($transactionOrder, 'TransactionOrder updated successfully');
        });
    }

    // TODO: Deletes a transaction order by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->transactionOrderRepository->deleteTransactionOrder($id);

            return $this->sendResponse([], 'TransactionOrder deleted successfully');
        });
    }
}
