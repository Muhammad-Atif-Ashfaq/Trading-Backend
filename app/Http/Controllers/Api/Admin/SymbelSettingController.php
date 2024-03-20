<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use App\Models\SymbelSetting;

class SymbelSettingController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new SymbelSetting();
    }
    
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbelSetting = $this->model::query();
            $groups = PaginationHelper::paginate(
                $symbelSetting,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($symbelSetting, 'All SymbelSetting');
        });
    }

    
    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbelSetting = $this->model::create([
                'name' => $request->name,
                'symbel_group_id'  => $request->symbel_group_id,
                'speed_min' => $request->speed_min,
                'speed_max' => $request->speed_max,
                'lot_size'  => $request->lot_size,
                'lot_step'  => $request->lot_step,
                'commission'=> $request->commission,
                'swap_long' => $request->swap_long,
                'swap_short'=> $request->swap_short,
                'enabled'   => $request->enabled,
                'viable'    => $request->viable
            ]);
            if($symbelSetting)
            {
                return $this->sendResponse($symbelSetting, 'SymbelSetting Store Successfully');
            }
        });
    }

    
    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $symbelSetting = $this->model::find($id);
            return $this->sendResponse($symbelSetting, 'Single SymbelSetting');
        });
    }

    
    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $symbelSetting = $this->model::find($id);
            $update = $symbelSetting->update([
                'name' => $request->name ?? $symbelSetting->name,
                'symbel_group_id'  => $request->symbel_group_id ?? $symbelSetting->symbel_group_id,
                'speed_min' => $request->speed_min ?? $symbelSetting->speed_min,
                'speed_max' => $request->speed_max ?? $symbelSetting->speed_max,
                'lot_size'  => $request->lot_size ?? $symbelSetting->lot_size,
                'lot_step'  => $request->lot_step ?? $symbelSetting->lot_step,
                'commission'=> $request->commission ?? $symbelSetting->commission,
                'swap_long' => $request->swap_long ?? $symbelSetting->swap_long,
                'swap_short'=> $request->swap_short ?? $symbelSetting->swap_short,
                'enabled'   => $request->enabled ?? $symbelSetting->enabled,
                'viable'    => $request->viable ?? $symbelSetting->viable
            ]);
            if ($update) {
                return $this->sendResponse($symbelSetting, 'SymbelSetting Update Successfully');
            }
        });
    }

    
    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $symbelSetting = $this->model::find($id)->delete();
            return $this->sendResponse($symbelSetting, 'SymbelSetting Deleted');
        });
    }
}