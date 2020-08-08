<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Controler\Builder\Reports\HistoricalDataBuilder;
use App\Controller\Builder\ReportDirector;
use App\Entity\HistoricalData;
use Doctrine\ORM\EntityManagerInterface;

final class HistoricalDataDataPersister implements DataPersisterInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof HistoricalData;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        if (
            $data instanceof HistoricalData && (
                ($context['collection_operation_name'] ?? null) === 'post'
            )
        ) {
            $this->generateReport($data);
        }
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

    private function generateReport($data)
    {
        $reportBuilder = new HistoricalDataBuilder();
        $reportData = (new ReportDirector())->build($reportBuilder);
        file_put_contents(__DIR__.'/teste.txt', print_r($reportData, true));
    }
}
