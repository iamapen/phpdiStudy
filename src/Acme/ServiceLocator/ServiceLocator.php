<?php
declare(strict_types=1);

namespace Acme\ServiceLocator;

use Acme\FooService;
use DI\NotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class ServiceLocator implements ContainerInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * ServiceLocator で公開するサービス群
     * @var string[]  alias => rawKey
     */
    private $aliases = [
        //'logger' => 'logger.file',
    ];


    /**
     * ServiceLocator constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!isset($this->aliases[$id])) {
            throw new NotFoundException($id);
        }

        return $this->container[$this->aliases[$id]];
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->aliases[$id]) && isset($this->container[$this->aliases[$id]]);
    }

    /**
     * @param string $name
     * @return LoggerInterface
     */
    public function getAppLogger()
    {
        return $this->container->get('logger.app');
    }

    public function getFooService()
    {
        return $this->container->get(FooService::class);
    }
}
