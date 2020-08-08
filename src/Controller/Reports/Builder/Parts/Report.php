<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder\Parts;

abstract class Report implements ReportInterface
{
    public int $statusCode;
    public string $contentType;
    public string $content;

    abstract public function setStatusCode(int $statusCode);

    abstract public function setContentType(string $contentType);

    abstract public function setContent(string $content);
}
