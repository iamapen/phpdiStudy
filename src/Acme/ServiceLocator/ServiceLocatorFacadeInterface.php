<?php
declare(strict_types=1);

namespace Acme\ServiceLocator;

interface ServiceLocatorFacadeInterface
{
    /**
     * @param string $name
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger($name);

    public static function getFooService();
}

