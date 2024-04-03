<?php

namespace App\Interfaces\Api\Admin;

interface TickAndChartInterface
{
    /**
     * TODO: Get all ticks.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllTicks($request);

    /**
     * TODO: Get all charts.
     *
     * @param  mixed  $request
     * @return mixed
     */
    public function getAllCharts($request);
}
