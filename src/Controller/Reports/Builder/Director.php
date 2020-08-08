<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder;

use App\Controller\Reports\Builder\Parts\Report;

class Director
{
    public function build(Builder $builder): Report
    {
        $builder->createReport();
        $builder->sendEmail();

        return $builder->getReport();
    }
}
