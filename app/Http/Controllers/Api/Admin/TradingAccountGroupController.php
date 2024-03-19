<?php

namespace App\Http\Controllers\Api\Admin;

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
    
    public function index()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $groups = $this->model::all();
            return $this->sendResponse($groups, 'All Groups');
        });
    }


    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($request) {
            $groups = $this->model::create([
                'name' => $request->name,
            ]);
            if($groups)
            {
                return $this->sendResponse($groups, 'Group Store Successfully');
            }
        });
    }

    
    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($id) {
            $groups = $this->model::find($id);
            return $this->sendResponse($groups, 'Single Group');
        });
    }

    
    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($id, $request) {
            $groups = $this->model::find($id);
            $update = $groups->update([
                'name' => $request->name,
            ]);
            if($update)
            {
                return $this->sendResponse($groups, 'groups Update Successfully');
            }
        });
    }

    
    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($id) {
            $groups = $this->model::find($id)->delete();
            return $this->sendResponse($groups, 'Group Deleted');
        });
    }
}
