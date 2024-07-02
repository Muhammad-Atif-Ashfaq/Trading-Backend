<?php

namespace App\Http\Controllers\Api\Brand;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Brand\SymbelGroupRepository;
use Illuminate\Http\Request;


class SymbelGroupController extends Controller
{
    protected $symbelGroupRepository;

    public function __construct(SymbelGroupRepository $symbelGroupRepository)
    {
        $this->symbelGroupRepository = $symbelGroupRepository;
    }

    public function getAllSymbelGroupList(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request){
            $symbelGroups = $this->symbelGroupRepository->getAllSymbelGroupList($request);
            return $this->sendResponse($symbelGroups, 'All SymbelGroups list');
        });
    }

}