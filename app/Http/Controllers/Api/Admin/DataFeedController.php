<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\DataFeedInterface;
use App\Http\Requests\Api\Admin\DataFeeds\Create as DataFeedCreate;
use Illuminate\Http\Request;


class DataFeedController extends Controller
{
    protected $dataFeedRepository;

    public function __construct(DataFeedInterface $dataFeedRepository)
    {
        $this->dataFeedRepository = $dataFeedRepository;
    }

    // TODO: Retrieves all data feeds.
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $DataFeeds = $this->dataFeedRepository->getAllDataFeeds($request);
            return $this->sendResponse($DataFeeds, 'All DataFeeds');
        });
    }

    // TODO: Stores a new data feed.
    public function store(DataFeedCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->dataFeedRepository->createDataFeed($request->validated());
            return $this->sendResponse($user, 'DataFeed created successfully');
        });
    }

    // TODO: Retrieves a single data feed by ID.
    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $DataFeed = $this->dataFeedRepository->findDataFeedById($id);
            return $this->sendResponse($DataFeed, 'Single DataFeed');
        });
    }

    // TODO: Updates a data feed.
    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $DataFeed = $this->dataFeedRepository->updateDataFeed($request, $id);
            return $this->sendResponse($DataFeed, 'DataFeed updated successfully');
        });
    }

    // TODO: Deletes a data feed by ID.
    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->dataFeedRepository->deleteDataFeed($id);
            return $this->sendResponse([], 'DataFeed deleted successfully');
        });
    }
}

