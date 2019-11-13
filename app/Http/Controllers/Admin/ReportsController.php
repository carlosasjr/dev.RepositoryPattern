<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportsChart;
use App\Enum\Enum;
use App\Repositories\Contracts\ReportsRepositoryInterface;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    private $repository;

    public function __construct(ReportsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function months(ReportsChart $chart)
    {
       /* $chart->labels(['JAN', 'FEB', 'MARC']);
        $chart->dataset('2019', 'line', [
            12, 14, 16
        ])->options(['backgroundColor' => '#999']);

        $chart->dataset('2018', 'line', [
            10, 18, 20
        ])->options(['backgroundColor' => '#333']); */


        $chart->labels(Enum::months());

        $chart->dataset('2017', 'bar',  $this->repository->byMonths(2017))
              ->options(['backgroundColor' => '#333']);


        $chart->dataset('2018', 'bar', $this->repository->byMonths(2018))
              ->options(['backgroundColor' => '#999']);



        return view('admin.charts.chart', compact('chart'));
    }

    public function months2()
    {
        $chart = $this->repository->getReports(2016, 2018);
        return view('admin.charts.chart', compact('chart'));
    }

    public function year()
    {
        $chart = $this->repository->getDataYears();

        return view('admin.charts.chart', compact('chart'));
    }
}
