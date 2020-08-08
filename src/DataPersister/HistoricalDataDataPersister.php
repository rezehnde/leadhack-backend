<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Controller\Reports\Builder\Director;
use App\Controller\Reports\Builder\HistoricalDataBuilder;
use App\Controller\Reports\Builder\Parts\Report;
use App\Entity\HistoricalData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class HistoricalDataDataPersister implements DataPersisterInterface
{
    private $entityManager;
    private $client;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof HistoricalData;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $this->generateReport($data);
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

    private function generateReport($data): Report
    {
        $historicalDataBuilder = new HistoricalDataBuilder($this->client);

        return (new Director())->build($historicalDataBuilder);
    }
}
