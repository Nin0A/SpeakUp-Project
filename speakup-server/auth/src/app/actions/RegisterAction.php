<?php

namespace auth\app\actions;

use auth\core\services\auth\ServiceAuth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

class RegisterAction
{
    private $authService;

    public function __construct(ServiceAuth $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        error_log('RegisterAction invoked');

        // Récupérer les données de la requête
        $data = $request->getParsedBody();
        error_log('Data received: ' . print_r($data, true));

        try {
            // Enregistrer l'utilisateur
            $credential = $this->authService->registerUser($data);

            error_log('User registered: ' . print_r($credential, true));

            // Préparer la réponse JSON
            $response->getBody()->write(json_encode($credential));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (Exception $e) {
            // Gérer les erreurs
            error_log('Error: ' . $e->getMessage());
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}
