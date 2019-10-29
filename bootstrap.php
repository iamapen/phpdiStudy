<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

//$c = new DI\Container();

// 設定
//foreach (require __DIR__ . '/config/config.php' as $id => $val) {
//    $c->set($id, $val);
//}

// DI
$builder = new DI\ContainerBuilder();
$builder->addDefinitions(require __DIR__ . '/config/config.php');
$builder->addDefinitions(require __DIR__ . '/container.php');
$c = $builder->build();


// コンテナにどうアクセスさせるかは課題
$locator = new \Acme\ServiceLocator\ServiceLocator($c);
FrameworkGlobals::init(['serviceLocator' => $locator]);

// これでもいいかなぁ
//\Acme\ServiceLocator\ServiceLocatorFacade::initialize($locator);

class FrameworkGlobals
{
    private static $vars;

    public static function init($vars)
    {
        static::$vars = $vars;
    }

    /**
     * @return \Acme\ServiceLocator\ServiceLocator
     */
    public static function getServiceLocator()
    {
        return static::$vars['serviceLocator'];
    }
}
