<?php

declare(strict_types=1);

use room\core\services\room\ServiceRoom;

return function (\Slim\App $app): \Slim\App {

    // Instancier le service de gestion des salles
    $serviceRoom = $app->getContainer()->get(ServiceRoom::class);

    // Définir un groupe de routes pour les salles
    $app->group('/rooms', function (\Slim\Routing\RouteCollectorProxy $group) use ($serviceRoom) {
        $group->post('', \room\app\actions\CreateRoomAction::class);
        // $group->get('/{roomId}', \room\app\actions\GetRoomAction::class); // Récupérer une salle par ID
        // $group->put('/{roomId}', \room\app\actions\UpdateRoomAction::class); // Mettre à jour une salle
        // $group->delete('/{roomId}', \room\app\actions\DeleteRoomAction::class); // Supprimer une salle

        // Sous-groupe pour les membres d'une salle
        // $group->group('/{roomId}/members', function (\Slim\Routing\RouteCollectorProxy $memberGroup) use ($serviceRoom) {
        //     $memberGroup->post('', \room\app\actions\AddMemberToRoomAction::class); // Ajouter un membre à une salle
        //     $memberGroup->delete('/{userId}', \room\app\actions\RemoveMemberFromRoomAction::class); // Supprimer un membre d'une salle
        // });
    });

    return $app;
};
