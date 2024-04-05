<?php
namespace App\Repositories\Api\Admin;

use App\Helpers\PaginationHelper;
use App\Interfaces\Api\Admin\TickAndChartInterface;
use App\Models\Chart;
use App\Models\Role;
use App\Models\Tick;
use App\Models\User;
use App\Models\Brand;
use App\Services\GenerateRandomService;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;

class TickAndChartRepository implements TickAndChartInterface
{
    private $tick;
    private $chart;

    public function __construct()
    {
        $this->tick = new Tick();
        $this->chart = new Chart();
    }

    // TODO: Get all ticks.
    public function getAllTicks($request)
    {
        $ticks = $this->tick->query();
        $ticks = PaginationHelper::paginate(
            $ticks,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_current_page'))
        );
        return $ticks;
    }

    // TODO: Get all charts.
    public function getAllCharts($request)
    {
        $charts = $this->chart->query();
        $charts = PaginationHelper::paginate(
            $charts,
            $request->input('per_page', config('systemSetting.system_per_page_count')),
            $request->input('page', config('systemSetting.system_per_page_count'))
        );
        return $charts;
    }
}
