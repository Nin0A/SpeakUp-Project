<?php

use auth\app\actions\RegisterAction;
use auth\app\actions\SignInAction;
use auth\core\providers\PasswordAuthProvider;
use auth\app\actions\ValidateAction;
use auth\core\services\auth\ServiceAuth;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Container\Container;
use auth\app\middlewares\AuthMiddleware;

return [

    // Configuration de la connexion à la base de données
    'db' => function () {
        $container = new Container;

        $capsule = new DB($container);

        $capsule->addConnection([
            'driver'    => getenv('DB_CONNECTION'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_DATABASE'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Setup the Eloquent ORM
        $capsule->bootEloquent();

        return $capsule;
    },

    // Service d'authentification
    ServiceAuth::class => function ($c) {
        return new ServiceAuth($c->get('db'));
    },

    // Fournisseur d'authentification par mot de passe
    PasswordAuthProvider::class => function ($c) {
        $jwtSecret = getenv('JWT_SECRET');
        return new PasswordAuthProvider($c->get(ServiceAuth::class), $jwtSecret);
    },

    // Action pour enregistrer un utilisateur
    RegisterAction::class => function ($c) {
        return new RegisterAction($c->get(ServiceAuth::class));
    },

    // Action pour connecter un utilisateur
    SignInAction::class => function ($c) {
        return new SignInAction($c->get(PasswordAuthProvider::class));
    },

    // Action pour valider un token
    ValidateAction::class => function ($c) {
        $jwtSecret = getenv('JWT_SECRET');
        return new ValidateAction($jwtSecret);
    },

    // Middleware d'authentification
    AuthMiddleware::class => function ($c) {
        $jwtSecret = getenv('JWT_SECRET');
        return new AuthMiddleware($jwtSecret);
    },

];
