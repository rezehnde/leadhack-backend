<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder;

use App\Controller\Reports\Builder\Parts\HistoricalDataReport;
use App\Controller\Reports\Builder\Parts\Report;

class HistoricalDataBuilder implements Builder
{
    private HistoricalDataReport $report;

    public function createReport()
    {
        $this->report = new HistoricalDataReport();
    }

    public function sendEmail()
    {
    }

    public function getReport(): Report
    {
        return $this->report;
    }
}
