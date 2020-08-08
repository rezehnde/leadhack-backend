<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder\Parts;

abstract class Report
{
    /**
     * @var object[]
     */
    private array $data = [];

    public function setPart(string $key, object $value)
    {
        $this->data[$key] = $value;
    }
}
