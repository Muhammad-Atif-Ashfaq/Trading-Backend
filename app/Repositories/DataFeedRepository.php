<?php
namespace App\Repositories;

use App\Helpers\PaginationHelper;
use App\Models\DataFeed;


class DataFeedRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new DataFeed();

    }

    public function getAllDataFeeds($request)
    {
        $dataFeeds = $this->model->query();
        $dataFeeds = PaginationHelper::paginate(
            $dataFeeds,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $dataFeeds;
    }

    public function createDataFeed(array $data)
    {

        $dataFeed = $this->model->create([
            'name' => $data['name'],
            'module' => $data['module'],
            'feed_server' => $data['feed_server'],
            'feed_login'  => $data['feed_login'] ?? null,
            'feed_password' => $data['feed_password'] ?? null
        ]);


        return $dataFeed;
    }

    public function findDataFeedById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateDataFeed(array $data, $id)
    {
        $dataFeed = $this->model->findOrFail($id);
        $dataFeed->update([
            'name' => $data['name'] ?? $dataFeed->name,
            'module' => $data['module'] ?? $dataFeed->module,
            'feed_server' => $data['feed_server'] ?? $dataFeed->feed_server,
            'feed_login'  => $data['feed_login'] ?? $dataFeed->feed_login,
            'feed_password' => $data['feed_password'] ?? $dataFeed->feed_password
        ]);
        return $dataFeed;
    }

    public function deleteDataFeed($id)
    {
        $this->model->findOrFail($id)->delete();
    }
}
