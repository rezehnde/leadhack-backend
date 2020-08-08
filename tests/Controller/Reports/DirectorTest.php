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
        $historicalDataBuilder = new HistoricalDataBuilder($client);
        $newReport = (new Director())->build($historicalDataBuilder);

        $this->assertInstanceOf(HistoricalDataReport::class, $newReport);
    }
}
