<?php
declare(strict_types=1);

//require __DIR__ . '/classes.php';
//require __DIR__ . '/container.php';

require __DIR__ . '/../bootstrap.php';

//$sample = $c['sample'];

//$logger1 = \ServiceLocator\ServiceLocatorFacade::getLogger();
//$logger2 = \ServiceLocator\ServiceLocatorFacade::getLogger();
//$logger3 = \ServiceLocator\ServiceLocatorFacade::getLogger('foo');

$logger1 = FrameworkGlobals::getServiceLocator()->getAppLogger();
$logger2 = FrameworkGlobals::getServiceLocator()->getAppLogger();
$logger3 = FrameworkGlobals::getServiceLocator()->getAppLogger('foo');

var_dump(get_class($logger1), get_class($logger2), get_class($logger3));
var_dump($logger1 === $logger2);

$logger1->info('hey');


$c = FrameworkGlobals::getServiceLocator();

$service = $c->getFooService();
var_dump($service);
