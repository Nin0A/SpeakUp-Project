<?php

namespace gateway\app\actions\auth;

use Psr\Http\Client\ClientInterface;
use gateway\app\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

class SignInAction extends AbstractAction
{
    private $authClient;

    public function __construct(ClientInterface $authClient)
    {
        $this->authClient = $authClient;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        // Récupérer les données de la requête
        $data = $request->getParsedBody();

        try {
            // Envoyer la requête au microservice d'authentification
            $apiResponse = $this->authClient->request('POST', '/auth/signin', [
                'json' => $data
            ]);

            // Récupérer le corps de la réponse du microservice
            $body = $apiResponse->getBody()->getContents();

            // Décoder le JSON pour s'assurer qu'il est valide
            $decodedBody = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response from microservice');
            }

            // Préparer la réponse JSON avec les données reçues du microservice
            $response->getBody()->write(json_encode($decodedBody));
            return $response->withHeader('Content-Type', 'application/json')->withStatus($apiResponse->getStatusCode());
        } catch (Exception $e) {
            // Gérer les erreurs
            $response->getBody()->write(json_encode(['error' => 'Authentication failed']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}
