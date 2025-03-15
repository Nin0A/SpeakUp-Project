<?php

namespace auth\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ValidateAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        // Récupérer les informations de l'utilisateur à partir de l'attribut ajouté par le middleware
        $user = $request->getAttribute('user');

        // Préparer la réponse JSON avec les informations de l'utilisateur
        $response->getBody()->write(json_encode(['message' => 'Valid Token', 'user' => $user]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
