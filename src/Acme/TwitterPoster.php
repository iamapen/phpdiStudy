<?php
declare(strict_types=1);

namespace Acme;

use Psr\Log\LoggerInterface;

class TwitterPoster implements ITwitterPoster
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}