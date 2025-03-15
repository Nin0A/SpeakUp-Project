<?php

namespace room\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use room\core\services\room\ServiceRoom;
use Exception;

class CreateRoomAction
{
    private $serviceRoom;

    public function __construct(ServiceRoom $serviceRoom)
    {
        $this->serviceRoom = $serviceRoom;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        // Récupérer les données de la requête
        $data = $request->getParsedBody();

        try {
            // Créer une nouvelle salle
            $room = $this->serviceRoom->createRoom($data);

            // Préparer la réponse JSON
            $response->getBody()->write(json_encode($room));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (Exception $e) {
            // Gérer les erreurs
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}
