<?php

namespace App\Repositories\Contracts;

interface ReportsRepositoryInterface
{
    public function byMonths(int $year) : array;
    public function getReports(int $yearStart = null, int $yearEnd = null, string $type = 'bar');
}

