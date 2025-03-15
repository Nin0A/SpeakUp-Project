<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

$builder = new ContainerBuilder();

// Ajout des paramètres et dépendances
$builder->addDefinitions(__DIR__ . '/settings.php');
$builder->addDefinitions(__DIR__ . '/dependencies.php');

$container = $builder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

(require_once __DIR__ . '/routes.php')($app);

return $app;
