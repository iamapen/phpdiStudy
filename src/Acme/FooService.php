<?php
declare(strict_types=1);

namespace Acme;

use Psr\Log\LoggerInterface;

class FooService
{
    private $logger;
    private $twitterManager;
    private $databaseUserAuthenticator;

    public function __construct(
        LoggerInterface $logger,
        ITwitterPoster $twitterPoster,
        IUserAuthenticator $userAuthenticator
    )
    {
        $this->logger = $logger;
        $this->twitterManager = $twitterPoster;
        $this->databaseUserAuthenticator = $userAuthenticator;
    }
}