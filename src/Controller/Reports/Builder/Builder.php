<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder;

use App\Controller\Reports\Builder\Parts\Report;
use App\Entity\ReportData;
use Swift_Mailer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface Builder
{
    public function __construct(HttpClientInterface $httpClient, Swift_Mailer $mailer);

    public function setRequestData(ReportData $data);

    public function createReport();

    public function sendEmail();

    public function getReport(): Report;
}
