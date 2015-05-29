<?php

class AjaxController extends BaseController {

    // Mengambil seluruh data service execution
    public function getFilterDate() {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');
        $id = Input::get('id');

        if ($id == 4) {
            $chart_data = ServiceExecution::select('services.name', DB::raw('COUNT(service_execution.id) as jumlah'))
                            ->leftJoin('services', 'services.id', '=','service_execution.service_id')
                            ->where(DB::raw('DATE_FORMAT(service_execution.created_at, "%d %b %Y")'), '>=', $date1)
                            ->where(DB::raw('DATE_FORMAT(service_execution.created_at, "%d %b %Y")'), '<=', $date2)
                            ->groupBy('services.id')
                            ->get();
        } else if ($id == 3) {
            $chart_data = ServiceExecution::select('services.name', DB::raw('COUNT(service_execution.id) as jumlah'))
                            ->leftJoin('services', 'services.id', '=','service_execution.service_id')
                            ->where(DB::raw('DATE_FORMAT(service_execution.created_at, "%Y")'), '=', $date1)
                            ->groupBy('services.id')
                            ->get();
        } else if ($id == 2) {
            $chart_data = ServiceExecution::select('services.name', DB::raw('COUNT(service_execution.id) as jumlah'))
                            ->leftJoin('services', 'services.id', '=','service_execution.service_id')
                            ->where(DB::raw('DATE_FORMAT(service_execution.created_at,"%b %Y")'), '=', $date1)
                            ->groupBy('services.id')
                            ->get();
        } else if ($id == 1) {
            $chart_data = ServiceExecution::select('services.name', DB::raw('COUNT(service_execution.id) as jumlah'))
                            ->leftJoin('services', 'services.id', '=','service_execution.service_id')
                            ->where(DB::raw('DATE_FORMAT(service_execution.created_at, "%d %b %Y")'), '=', $date1)
                            ->groupBy('services.id')
                            ->get();
        }  else if ($id == 0) {
            $chart_data = ServiceExecution::select('services.name', DB::raw('COUNT(service_execution.id) as jumlah'))
                            ->leftJoin('services', 'services.id', '=','service_execution.service_id')
                            ->groupBy('services.id')
                            ->get();
        }

        $response = '';

        foreach ($chart_data as $key => $value){
            $response .= '<tr><th>'.$value->name.'</th><td>'.$value->jumlah.'</td></tr>';
        }

        return View::make('layouts.ajax')
                ->with('response', $response);
    }

}