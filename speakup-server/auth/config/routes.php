<?php

declare(strict_types=1);

use auth\app\middlewares\CorsMiddleware;
use auth\app\actions\RegisterAction;
use auth\app\actions\SignInAction;
use auth\app\actions\ValidateAction;
use auth\app\middlewares\AuthMiddleware;

return function (\Slim\App $app): \Slim\App {

    // Route pour l'inscription (register)
    $app->post('/auth/register', RegisterAction::class);

    // Route pour la connexion (signin)
    $app->post('/auth/signin', SignInAction::class);

    // Route pour la validation JWT token (validate)
    $app->get('/auth/validate', ValidateAction::class)->add(AuthMiddleware::class);


    $app->add(new CorsMiddleware());


    return $app;
};
