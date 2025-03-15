<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$builder = new ContainerBuilder();

// Ajout des paramètres et dépendances
$builder->addDefinitions(__DIR__ . '/settings.php');
$builder->addDefinitions(__DIR__ . '/dependencies.php');

$container = $builder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();


// Charger les variables d'environnement à partir du fichier .env
$dotenv = Dotenv::createImmutable(realpath(__DIR__ . '/../'));
$dotenv->load();

(require_once __DIR__ . '/routes.php')($app);

return $app;
