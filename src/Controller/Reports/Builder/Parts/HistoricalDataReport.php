<?php

declare(strict_types=1);

namespace App\Controller\Reports\Builder\Parts;

class HistoricalDataReport extends Report
{
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
