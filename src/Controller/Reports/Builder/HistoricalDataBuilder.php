<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder;

use App\Controller\Reports\Builder\Parts\HistoricalDataReport;
use App\Controller\Reports\Builder\Parts\Report;
use App\Entity\HistoricalData;
use App\Entity\ReportData;
use Swift_Mailer;
use Swift_Message;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HistoricalDataBuilder implements Builder
{
    private HistoricalDataReport $report;
    private HttpClientInterface $httpClient;
    private HistoricalData $data;
    private Swift_Mailer $mailer;

    public function __construct(
        HttpClientInterface $httpClient,
        Swift_Mailer $mailer
    ) {
        $this->httpClient = $httpClient;
        $this->mailer = $mailer;
    }

    public function setRequestData(ReportData $data)
    {
        $this->data = $data;
    }

    public function createReport()
    {
        $response = $this->httpClient->request(
            'GET',
            'https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-historical-data',
            [
                'headers' => [
                    'x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com',
                    'x-rapidapi-key' => $_ENV['RAPID_API_KEY'],
                    'useQueryString' => true,
                ],
                'query' => [
                    'period1' => date_timestamp_get($this->data->getStartDate()),
                    'period2' => date_timestamp_get($this->data->getEndDate()),
                    'symbol' => $this->data->getCompanySymbol(),
                ],
            ]
        );
        $historicalDataReport = new HistoricalDataReport();
        $historicalDataReport->setStatusCode($response->getStatusCode());
        $historicalDataReport->setContentType($response->getHeaders()['content-type'][0]);
        $historicalDataReport->setContent($response->getContent());
        $this->report = $historicalDataReport;
    }

    public function sendEmail()
    {
        $company = $this->data->getCompanySymbol();
        $startDate = $this->data->getStartDate()->format('Y-m-d');
        $endDate = $this->data->getEndDate()->format('Y-m-d');
        $email = $this->data->getEmail();
        $message = (new Swift_Message($company))
            ->setFrom($_ENV['ADMIN_EMAIL'])
            ->setTo($email)
            ->setBody($startDate.' to '.$endDate)
        ;
        $this->mailer->send($message);
    }

    public function getReport(): Report
    {
        return $this->report;
    }
}
