<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Charts\ReportsChart;
use App\Enum\Enum;
use App\Helpers\Helper;
use App\Repositories\Contracts\ReportsRepositoryInterface;
use App\Repositories\Core\BaseQueryBuilderRepository;
use DB;
use function foo\func;

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
            ->pluck('total')
            ->toArray();


        /* $dataset = [];
         foreach ($reports as $key => $value) {
             $dataset[] = $value->total;
         }*/


        return $dataset;
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

    public function getDataYears()
    {
        $data = $this->db
            ->table($this->table)
            ->select(DB::raw('YEAR(date) as year'),
                     DB::raw('sum(total) as total'))
            //   ->whereYear('date', $year)
            ->groupBy(DB::raw('YEAR(date)'))
            ->get();


       $labels = $data->pluck('year');

        $backgrounds = $data->map(function ($value, $key) {
            return Helper::colorRand();
        });

        $values = $data->map(function ($value, $key) {
          return number_format($value->total, 2, '0', '');
        });


        $chart = new ReportsChart();

        $chart->labels($labels)
              ->dataset('Relatório de vendas', 'bar', $values)
              ->backgroundColor($backgrounds);

        return $chart;
    }
}


