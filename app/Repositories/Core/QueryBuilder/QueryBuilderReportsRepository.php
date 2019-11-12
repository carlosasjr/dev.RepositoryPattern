<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Charts\ReportsChart;
use App\Enum\Enum;
use App\Helpers\Helper;
use App\Repositories\Contracts\ReportsRepositoryInterface;
use App\Repositories\Core\BaseQueryBuilderRepository;
use DB;

class QueryBuilderReportsRepository extends BaseQueryBuilderRepository implements ReportsRepositoryInterface
{
    protected $table = 'orders';

    public function byMonths(int $year): array
    {
        $dataset = $this->db
                        ->table($this->table)
                        ->select(DB::raw('sum(total) as total'))
                        ->whereYear('date', $year)
                        ->groupBy(DB::raw('MONTH(date)'))
                        ->pluck('total') //coluna que vai retornar
                        ->toArray();


       /* $dataset = [];
        foreach ($reports as $key => $value) {
            $dataset[] = $value->total;
        }*/


         return$dataset;
    }

    public function getReports(int $yearStart = null, int $yearEnd = null, string $type = 'bar')
    {
       $yearStart = $yearStart ?? date('Y') - 3;
       $yearEnd = $yearEnd ?? date('Y');

        $chart = new ReportsChart();

        $chart->labels(Enum::months());

        for ($year = $yearStart; $year <= $yearEnd; $year++) {
            $color = Helper::colorRand();

            $chart->dataset($year, $type, $this->byMonths($year))
                  ->options([
                      'color' => $color,
                      'backgroundColor' => $color
                  ]);
        }

        return $chart;

    }
}


