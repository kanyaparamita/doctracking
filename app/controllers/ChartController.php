<?php

class ChartController extends \BaseController {
    public function index()
    {
        $chart_data =   DB::table('service_execution')
                            ->leftJoin('services', 'services.id', '=','service_execution.service_id')
                            ->select('services.name', DB::raw('COUNT(service_execution.id) as jumlah'))
                            ->groupBy('services.id')
                            ->get();

        return View::make('chart')
                ->with('chart_data', $chart_data);
    }

}
