<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
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
            $this->doSomething($data);
        }
    }

    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

    private function doSomething($data)
    {
    }
}
