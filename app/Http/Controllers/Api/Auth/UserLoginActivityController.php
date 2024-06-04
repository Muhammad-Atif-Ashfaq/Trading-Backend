<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Http\Requests\Api\Auth\UserLoginActivity\Create as UserLoginActivityCreate;
use App\Repositories\Api\Auth\UserLoginActivityRepository;
use Illuminate\Http\Request;


class UserLoginActivityController extends Controller
{
    protected $userLoginActivityRepository;

    public function __construct(UserLoginActivityRepository $userLoginActivityRepository)
    {
        $this->userLoginActivityRepository = $userLoginActivityRepository;
    }

    // TODO: Retrieves all UserLoginActivitys.
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $UserLoginActivitys = $this->userLoginActivityRepository->getAllUserLoginActivitys($request);
            return $this->sendResponse($UserLoginActivitys, 'All User Login Activities');
        });
    }

    // TODO: Retrieves all trading UserLoginActivitys list.
    public function getAllUserLoginActivityList()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $UserLoginActivitys = $this->userLoginActivityRepository->getAllUserLoginActivityList();
            return $this->sendResponse($UserLoginActivitys, 'All User Login Activities list');
        });
    }

    // TODO: Stores a new UserLoginActivity.
    public function store(UserLoginActivityCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->userLoginActivityRepository->createUserLoginActivity($request->validated());
            return $this->sendResponse($user, 'User Login Activity created successfully');
        });
    }

    // TODO: Retrieves a single UserLoginActivity by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $UserLoginActivity = $this->userLoginActivityRepository->findUserLoginActivityById($id);
            return $this->sendResponse($UserLoginActivity, 'Single User Login Activity');
        });
    }

    // TODO: Updates a UserLoginActivity.
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $UserLoginActivity = $this->userLoginActivityRepository->updateUserLoginActivity($request->all(), $id);
            return $this->sendResponse($UserLoginActivity, 'User Login Activity updated successfully');
        });
    }

    // TODO: Deletes a UserLoginActivity by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->userLoginActivityRepository->deleteUserLoginActivity($id);
            return $this->sendResponse([], 'User Login Activity deleted successfully');
        });
    }
}

