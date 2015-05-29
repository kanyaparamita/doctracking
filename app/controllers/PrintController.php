<?php

class PrintController extends \BaseController {

    public function checklist($token)
    {
        if ($token != '') {
            $se_id = Executor::getServiceExecutionFromToken($token);
            $se = ServiceExecution::find($se_id);
            $customer = Customer::find($se->customer_id);
            $service  = $se->service;
            $requirements = ServiceRequirement::select('service_requirements.*', 'requirements.value as name', 'rs.data', 'rs.id as rs_id')
                            ->where('service_requirements.service_id', '=', $se->service_id)
                            ->leftJoin('requirements', 'service_requirements.requirement_id', '=', 'requirements.id')
                            ->leftJoin(DB::raw('(select * from requirement_storages where se_id = \''. $se_id.'\') as rs'),  'rs.requirement_id', '=', 'service_requirements.id')
                            ->get();

            $view = View::make('print.checklist')
                        ->with('customer', $customer)
                        ->with('service', $service)
                        ->with('token', $token)
                        ->with('requirements', $requirements)->render();

            return $view;
        }
    }

}
