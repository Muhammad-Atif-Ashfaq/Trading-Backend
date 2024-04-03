<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\TransactionOrderRepository;
use App\Http\Requests\Api\Admin\TransactionOrders\Create as TransactionOrderCreate;
use Illuminate\Http\Request;


class TransactionOrderController extends Controller
{
    protected $transactionOrderRepository;

    public function __construct(TransactionOrderRepository $transactionOrderRepository)
    {
        $this->transactionOrderRepository = $transactionOrderRepository;
    }

    // TODO: Retrieves all transaction orders.
    public function index(Request $request)
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
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $transactionOrder = $this->transactionOrderRepository->updateTransactionOrder($request, $id);
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

