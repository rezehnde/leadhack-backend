<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder;

use App\Controller\Reports\Builder\Parts\HistoricalDataReport;
use App\Controller\Reports\Builder\Parts\Report;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HistoricalDataBuilder implements Builder
{
    private HistoricalDataReport $report;
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function createReport()
    {
        $response = $this->client->request(
            'GET',
            'https://api.github.com/repos/symfony/symfony-docs'
        );
        $content = $response->getContent();
        $historicalDataReport = new HistoricalDataReport();
        $historicalDataReport->setStatusCode($response->getStatusCode());
        $historicalDataReport->setContentType($response->getHeaders()['content-type'][0]);
        $historicalDataReport->setContent($response->getContent());
        $this->report = $historicalDataReport;
    }

    public function sendEmail()
    {
        // send_email $this->report->content
    }

    public function getReport(): Report
    {
        return $this->report;
    }
}
