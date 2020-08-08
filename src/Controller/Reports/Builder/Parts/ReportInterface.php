<?php

namespace App\Controller\Reports\Builder\Parts;

interface ReportInterface
{
    public function setStatusCode(int $statusCode);

    public function setContentType(string $contentType);

    public function setContent(string $content);
}
