<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use App\Models\SymbelGroup;

class SymbelGroupController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new SymbelGroup();
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbelGroup = $this->model::query();
            $symbel = PaginationHelper::paginate(
                $symbelGroup,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($symbel, 'All SymbelGroup');
        });
    }

    
    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbel = $this->model::create([
                'name'   =>   $request->name,
                'Leverage' => $request->leverage,
                'lot_size' => $request->lot_size,
                'lot_step' => $request->lot_step,
                'vol_min'  => $request->vol_min,
                'vol_max'  => $request->vol_max,
                'trading_interval' => $request->trading_interval
            ]);
            if($symbel)
            {
                return $this->sendResponse($symbel, 'SymbelGroup Store Successfully');
            }
        });
    }

    
    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $symbel = $this->model::find($id);
            return $this->sendResponse($symbel, 'Single SymbelGroup');
        });
    }

    
    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $symbel = $this->model::find($id);
            $update = $symbel->update([
                'name'   =>   $request->name ?? $symbel->name,
                'Leverage' => $request->leverage ?? $symbel->leverage,
                'lot_size' => $request->lot_size ?? $symbel->lot_size,
                'lot_step' => $request->lot_step ?? $symbel->lot_step,
                'vol_min'  => $request->vol_min ?? $symbel->vol_min,
                'vol_max'  => $request->vol_max ?? $symbel->vol_max,
                'trading_interval' => $request->trading_interval ?? $symbel->trading_interval
            ]);
            if ($update) {
                return $this->sendResponse($symbel, 'SymbelGroup Update Successfully');
            }
        });
    }

    
    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $symbel = $this->model::find($id)->delete();
            return $this->sendResponse($symbel, 'SymbelGroup Deleted');
        });
    }
}
