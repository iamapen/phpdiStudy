<?php
declare(strict_types=1);

namespace Acme\ServiceLocator;

class ServiceLocatorFacade implements ServiceLocatorFacadeInterface
{
    /** @var ServiceLocator */
    private static $locator;

    public static function initialize(ServiceLocator $locator)
    {
        self::$locator = $locator;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public static function get($id)
    {
        return static::$locator->get($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public static function has($id)
    {
        return static::$locator->has($id);
    }

    /**
     * @inheritDoc
     */
    public static function getLogger($name = 'app')
    {
        return static::get('logger')($name);
    }

    public static function getFooService()
    {
        return static::$locator->get('service.foo');
    }
}
