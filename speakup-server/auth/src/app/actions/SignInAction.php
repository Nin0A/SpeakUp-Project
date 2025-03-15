<?php

namespace auth\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use auth\core\providers\PasswordAuthProvider;
use Exception;

class SignInAction
{
    private $authProvider;

    public function __construct(PasswordAuthProvider $authProvider)
    {
        $this->authProvider = $authProvider;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        // Récupérer les données de la requête
        $data = $request->getParsedBody();

        try {
            // Authentifier l'utilisateur et obtenir le JWT
            $token = $this->authProvider->authenticate($data);

            if ($token) {
                // Préparer la réponse JSON avec le JWT
                $response->getBody()->write(json_encode(['token' => $token]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } else {
                // Préparer la réponse JSON en cas d'échec
                $response->getBody()->write(json_encode(['error' => 'Invalid credentials']));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
            }
        } catch (Exception $e) {
            // Gérer les erreurs
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}
