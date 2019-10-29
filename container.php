<?php
declare(strict_types=1);

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

return [
    'logger.app' => function(ContainerInterface $c) {
        $name = 'app';
        static $loggers = [];
        if (isset($loggers[$name])) {
            return $loggers[$name];
        }

        $logfile = sprintf('%s/%s', $c->get('config.log.logDir'), $name);
        $maxdays = (int) $c->get('config.log.maxDays');
        $loglevel = $c->get('config.log.logLevel');

        $handler = new RotatingFileHandler($logfile, $maxdays, Logger::toMonologLevel($loglevel), true, 0666);
        $handler->setFilenameFormat('{filename}_{date}', 'Ymd');

        $logger = new Logger($name);
        $logger->pushHandler($handler);

        $loggers[$name] = $logger;
        return $logger;
    },

    // TODO remove
    'logger.file' => function(ContainerInterface $c) {
        return function ($name) use ($c) {
            static $loggers = [];
            if (isset($loggers[$name])) {
                return $loggers[$name];
            }

            $logfile = sprintf('%s/%s', $c->get('config.log.logDir'), $name);
            $maxdays = (int) $c->get('config.log.maxDays');
            $loglevel = $c->get('config.log.logLevel');

            $handler = new RotatingFileHandler($logfile, $maxdays, Logger::toMonologLevel($loglevel), true, 0666);
            $handler->setFilenameFormat('{filename}_{date}', 'Ymd');

            $logger = new Logger($name);
            $logger->pushHandler($handler);

            $loggers[$name] = $logger;
            return $logger;
        };
    },

    \Acme\ITwitterPoster::class => function(ContainerInterface $c) {
        return new \Acme\TwitterPoster($c->get('logger.app'));
    },

    \Acme\IUserAuthenticator::class => DI\autowire(\Acme\UserAuthenticator::class),

    \Acme\FooService::class => function(ContainerInterface $c) {
        return new \Acme\FooService(
            $c->get('logger.app'),
            $c->get(\Acme\ITwitterPoster::class),
            $c->get(\Acme\IUserAuthenticator::class)
        );
    },
];
