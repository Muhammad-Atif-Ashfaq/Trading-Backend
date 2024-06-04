<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\FireWall\AddToIpList;
use App\Repositories\Api\Admin\FireWallRepository;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use Illuminate\Http\Request;


class FireWallController extends Controller
{

    protected $fireWallRepository;

    public function __construct(FireWallRepository $fireWallRepository)
    {
        $this->fireWallRepository = $fireWallRepository;
    }

    // TODO: Retrieves all ip_list.
    public function getAllIpLists(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $ip_list = $this->fireWallRepository->getAllIpLists($request);
            return $this->sendResponse($ip_list, 'All Ip list');
        });
    }


    // TODO: Retrieves all  block_list.
    public function addToIpList(AddToIpList $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->fireWallRepository->addToIpList($request->validated());
            return $this->sendResponse($user, 'Ip created successfully');
        });
    }



}
