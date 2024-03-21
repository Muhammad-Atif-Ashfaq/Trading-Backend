<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\SymbelSettingRepository;
use App\Http\Requests\Api\Admin\SymbelSettings\Create as SymbelSettingCreate;
use Illuminate\Http\Request;


class SymbelSettingController extends Controller
{
    protected $symbelSettingRepository;

    public function __construct(SymbelSettingRepository $symbelSettingRepository)
    {
        $this->symbelSettingRepository = $symbelSettingRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbelSettings = $this->symbelSettingRepository->getAllSymbelSettings($request);
            return $this->sendResponse($symbelSettings, 'All SymbelSettings');
        });
    }

    public function store(SymbelSettingCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->symbelSettingRepository->createSymbelSetting($request->validated());
            return $this->sendResponse($user, 'SymbelSetting created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $symbelSetting = $this->symbelSettingRepository->findSymbelSettingById($id);
            return $this->sendResponse($symbelSetting, 'Single SymbelSetting');
        });
    }

    public function update(SymbelSettingCreate $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $symbelSetting = $this->symbelSettingRepository->updateSymbelSetting($request->validated(), $id);
            return $this->sendResponse($symbelSetting, 'SymbelSetting updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->symbelSettingRepository->deleteSymbelSetting($id);
            return $this->sendResponse([], 'SymbelSetting deleted successfully');
        });
    }
}

