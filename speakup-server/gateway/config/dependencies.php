<?php

use Psr\Container\ContainerInterface;
use GuzzleHttp\Client;
use gateway\app\middlewares\CorsMiddleware;
use gateway\app\actions\auth\SignInAction;

return [

    'message_client' => function (ContainerInterface $c) {
        return new Client([
            'base_uri' => $c->get('api.message'),
            'timeout' => 2.0
        ]);
    },

    'auth_client' => function (ContainerInterface $c) {
        return new Client([
            'base_uri' => $c->get('api.auth'),
            'timeout' => 2.0
        ]);
    },

    'room_client' => function (ContainerInterface $c) {
        return new Client([
            'base_uri' => $c->get('api.room'),
            'timeout' => 2.0
        ]);
    },

    'user_client' => function (ContainerInterface $c) {
        return new Client([
            'base_uri' => $c->get('api.user'),
            'timeout' => 2.0
        ]);
    },

    'communication_client' => function (ContainerInterface $c) {
        return new Client([
            'base_uri' => $c->get('api.communication'),
            'timeout' => 2.0
        ]);
    },

    // Middlewares
    CorsMiddleware::class => function () {
        return new CorsMiddleware();
    },

    SignInAction::class => function (ContainerInterface $container) {
        return new SignInAction($container->get('auth_client'));
    },

    // GetUserParamsAction::class => function (ContainerInterface $container) {
    //     return new GetUserParamsAction($container->get('user_client'));
    // },

    // GetMessagesAction::class => function (ContainerInterface $container) {
    //     return new GetMessagesAction($container->get('message_client'));
    // },

    // GetRoomsAction::class => function (ContainerInterface $container) {
    //     return new GetRoomsAction($container->get('room_client'));
    // },

    // AddRoomMemberAction::class => function (ContainerInterface $container) {
    //     return new AddRoomMemberAction($container->get('room_client'));
    // },

    // GetRoomMembersAction::class => function (ContainerInterface $container) {
    //     return new GetRoomMembersAction($container->get('room_client'));
    // },

    // ConnectToRoomAction::class => function (ContainerInterface $container) {
    //     return new ConnectToRoomAction($container->get('room_client'));
    // },

    // DisconnectFromRoomAction::class => function (ContainerInterface $container) {
    //     return new DisconnectFromRoomAction($container->get('room_client'));
    // },

    // CandidateRoomAction::class => function (ContainerInterface $container) {
    //     return new CandidateRoomAction($container->get('room_client'));
    // },

    // AnswerOfferAction::class => function (ContainerInterface $container) {
    //     return new AnswerOfferAction($container->get('room_client'));
    // },

    // SignalAction::class => function (ContainerInterface $container) {
    //     return new SignalAction($container->get('signalisation_client'));
    // },

];
