<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use Illuminate\Http\Request;
use App\Models\DataFeed;

class DataFeedController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new DataFeed();
    }
    
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $dataFeed = $this->model::query();
            $groups = PaginationHelper::paginate(
                $dataFeed,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($groups, 'All Data Feed');
        });
    }



    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $dataFeed = $this->model::create([
                'name' => $request->name,
                'module' => $request->module,
                'feed_server' => $request->feed_server,
                'feed_login'  => $request->feed_login,
                'feed_password' => $request->feed_password
            ]);
            if ($dataFeed) {
                return $this->sendResponse($dataFeed, 'Data Feed Store Successfully');
            }
        });
    }


    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $dataFeed = $this->model::find($id);
            return $this->sendResponse($dataFeed, 'Single Data Feed');
        });
    }


    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $dataFeed = $this->model::find($id);
            $update = $dataFeed->update([
                'name' => $request->name ?? $dataFeed->name,
                'module' => $request->module ?? $dataFeed->module,
                'feed_server' => $request->feed_server ?? $dataFeed->feed_server,
                'feed_login'  => $request->feed_login ?? $dataFeed->feed_login,
                'feed_password' => $request->feed_password ?? $dataFeed->feed_password
            ]);
            if ($update) {
                return $this->sendResponse($dataFeed, 'Data Feed Update Successfully');
            }
        });
    }

    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $dataFeed = $this->model::find($id)->delete();
            return $this->sendResponse($dataFeed, 'Data Feed Deleted');
        });
    }
}
