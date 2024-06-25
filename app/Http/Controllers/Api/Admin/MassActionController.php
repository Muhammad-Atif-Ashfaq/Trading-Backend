<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Api\Admin\MassActionRepository;
use App\Http\Requests\Api\Admin\MassAction\MassEdit;
use App\Http\Requests\Api\Admin\MassAction\MassDelete;
use App\Http\Requests\Api\Admin\MassAction\MassImport;
use App\Http\Requests\Api\Admin\MassAction\MassCloseOrders;
use App\Helpers\ExceptionHandlerHelper;

class MassActionController extends Controller
{
    protected $massActionRepository;

    public function __construct(MassActionRepository $massActionRepository)
    {
        $this->massActionRepository = $massActionRepository;
    }

    public function massEdit(MassEdit $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tableName = $request->input('table_name');
            // Get the fillable attributes for the specified table
            $fillableAttributes = app(tableToModel($tableName))->getFillable();
            // Pass the fillable attributes along with the validated data to the repository

            $action = $this->massActionRepository->massEdit(
                $request->validated(),
                skipValue0($request->only($fillableAttributes))
            );
            return $this->sendResponse($action, 'Updated successfully');
        });
    }


    public function massDelete(MassDelete $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $action = $this->massActionRepository->massDelete($request->validated());
            return $this->sendResponse($action, 'Deleted successfully');
        });
    }

    public function massImport(MassImport $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $action = $this->massActionRepository->massImport($request->validated());
            return $this->sendResponse($action, 'Imported successfully');
        });
    }

    public function massCloseOrders(MassCloseOrders $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $action = $this->massActionRepository->massCloseOrders($request->input('ids'));
            return $this->sendResponse($action, 'Closed successfully');
        });
    }
}
