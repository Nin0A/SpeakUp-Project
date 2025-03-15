<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Container\Container;
use room\core\services\room\ServiceRoom;
use room\app\actions\CreateRoomAction;

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

    // Service pour gérer les salles
    ServiceRoom::class => function ($c) {
        return new ServiceRoom($c->get('db'));
    },

    // Action pour créer une salle
    CreateRoomAction::class => function ($c) {
        return new CreateRoomAction($c->get(ServiceRoom::class));
    },

];
