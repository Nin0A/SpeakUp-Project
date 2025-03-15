<?php

declare(strict_types=1);

use auth\app\middlewares\CorsMiddleware;
use auth\app\actions\RegisterAction;
use auth\app\actions\SignInAction;


return function (\Slim\App $app): \Slim\App {

    // Route pour l'inscription (register)
    $app->post('/auth/register', RegisterAction::class);

    // Route pour la connexion (signin)
    $app->post('/auth/signin', SignInAction::class);

    // $app->post('/auth/validate', ValidateAction::class)
    //     ->add(\auth\application\middlewares\AuthMiddleware::class);

    $app->add(new CorsMiddleware());


    return $app;
};
