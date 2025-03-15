<?php

declare(strict_types=1);

use gateway\app\actions\HomeAction;
use gateway\app\middlewares\CorsMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
// use gateway\application\actions\User\GetUserParamsAction;
// use gateway\application\actions\Message\GetMessagesAction;
// use gateway\application\actions\Room\GetRoomsAction;
// use gateway\application\actions\Room\GetRoomMembersAction;
// use gateway\application\actions\Room\ConnectToRoomAction;
// use gateway\application\actions\Room\DisconnectFromRoomAction;
// use gateway\application\actions\Room\CandidateRoomAction;
// use gateway\application\actions\Room\AnswerOfferAction;
// use gateway\application\actions\Signalisation\SignalAction;

return function (\Slim\App $app): \Slim\App {

    $app->add(CorsMiddleware::class);

    // // Routes pour le microservice User/Params
    // $app->group('/users', function (\Slim\App $app) {
    //     $app->get('/{userId}/devices', GetUserParamsAction::class);
    // });

    // // Routes pour le microservice Message
    // $app->group('/rooms', function (\Slim\App $app) {
    //     $app->get('/{roomId}/messages', GetMessagesAction::class);
    // });

    // // Routes pour le microservice Room
    // $app->group('/users', function (\Slim\App $app) {
    //     $app->get('/{userId}/rooms', GetRoomsAction::class);
    // });

    $app->group('/rooms', function (\Slim\App $app) {
        $app->get('/{roomId}/members', GetRoomMembersAction::class);
        $app->post('/{roomId}/members', AddRoomMemberAction::class);
        $app->delete('/{roomId}/members/{userId}', RemoveRoomMemberAction::class);
        // $app->post('/{roomId}/connect', ConnectToRoomAction::class);
        // $app->post('/{roomId}/disconnect', DisconnectFromRoomAction::class);
        // $app->post('/{roomId}/candidate', CandidateRoomAction::class);
        // $app->post('/{roomId}/answer-offer', AnswerOfferAction::class);
    });

    // // Routes pour le microservice Signalisation
    // $app->post('/signal', SignalAction::class);

    //HomeAction
    $app->get('/speakup', HomeAction::class);

    // Route CORS pour les pré-requêtes OPTIONS
    $app->options('/{routes:.+}', function (Request $request, Response $response) {
        return $response;
    });

    return $app;
};
