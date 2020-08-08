<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder;

use App\Controller\Reports\Builder\Parts\Report;
use App\Entity\ReportData;

interface Builder
{
    public function setRequestData(ReportData $data);

    public function createReport();

    public function sendEmail();

    public function getReport(): Report;
}
