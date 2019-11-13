<?php

namespace App\Repositories\Core\Eloquent;

use App\Charts\ReportsChart;
use App\Enum\Enum;
use App\Helpers\Helper;
use App\Models\Order;
use App\Repositories\Contracts\ReportsRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use DB;

class EloquentReportsRepository extends BaseEloquentRepository
    implements ReportsRepositoryInterface
{
    public function entity()
    {
        return Order::class;
    }

    /*
     *       $dataset = $this->db
            ->table($this->table)
            ->select(DB::raw('sum(total) as total'))
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total') //coluna que vai retornar
            ->toArray();
     *
     */
    public function byMonths(int $year): array
    {
        $data = $this->entity
            ->select(DB::raw('sum(total) as total'))
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total') //coluna que vai retornar
            ->toArray();

        return $data;

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
        $data = $this->entity
                     ->select(DB::raw('sum(total) as total'), DB::raw('YEAR(date) as year'))
                     ->groupBy(DB::raw('YEAR(date)'))
                     ->get();

        $labels = $data->pluck('year');
        $values = $data->pluck('total');

        $background = $data->map(function ($value, $key) {
           return Helper::colorRand();
        });

        $chart = new ReportsChart();

        $chart->labels($labels)
              ->dataset('Relatório anual', 'bar', $values)
              ->backgroundColor($background);

        return $chart;
    }
}

