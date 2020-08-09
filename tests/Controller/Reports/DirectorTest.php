<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder\Tests;

use App\Controller\Reports\Builder\Director;
use App\Controller\Reports\Builder\HistoricalDataBuilder;
use App\Controller\Reports\Builder\Parts\HistoricalDataReport;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;

/**
 * @internal
 * @coversNothing
 */
class DirectorTest extends TestCase
{
    public function testCanBuildHistoricalDataReport()
    {
        $client = new MockHttpClient();
        /** @var \Swift_Mailer&\PHPUnit\Framework\MockObject\MockObject $mailer */
        $mailer = $this->createMock(\Swift_Mailer::class);
        $historicalDataBuilder = new HistoricalDataBuilder($client, $mailer);
        $newReport = (new Director())->build($historicalDataBuilder);

        $this->assertInstanceOf(HistoricalDataReport::class, $newReport);
    }
}
