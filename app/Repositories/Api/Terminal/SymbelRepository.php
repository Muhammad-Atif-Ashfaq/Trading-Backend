<?php
namespace App\Repositories\Api\Terminal;

use App\Helpers\PaginationHelper;
use App\Models\SymbelGroup;
use Illuminate\Database\Eloquent\Model;


class SymbelRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new SymbelGroup();
    }

    public function getAllSymbels()
    {
        $symbelGroup = $this->model::with('settings')->get();
        return $symbelGroup;
    }

}
