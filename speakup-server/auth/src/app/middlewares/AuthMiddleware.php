<?php

namespace auth\app\middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Exception;

class AuthMiddleware implements MiddlewareInterface
{
    private $jwtSecret;

    public function __construct(string $jwtSecret)
    {
        $this->jwtSecret = $jwtSecret;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        // Récupérer le token de la requête (par exemple, à partir de l'en-tête d'autorisation)
        $authorizationHeader = $request->getHeaderLine('Authorization');

        if (empty($authorizationHeader) || !str_starts_with($authorizationHeader, 'Bearer ')) {
            $response = $this->createResponse(['error' => 'Token not provided'], 401);
            return $response;
        }

        $token = substr($authorizationHeader, 7); // Supprimer "Bearer "

        try {
            // Décoder et vérifier le JWT
            $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));

            // Ajouter les informations du token à la requête pour une utilisation ultérieure
            $request = $request->withAttribute('user', (array) $decoded);

            // Continuer avec la requête suivante
            return $handler->handle($request);
        } catch (ExpiredException $e) {
            return $this->createResponse(['error' => 'Token has expired'], 401);
        } catch (Exception $e) {
            return $this->createResponse(['error' => 'Invalid token'], 401);
        }
    }

    private function createResponse(array $data, int $status): Response
    {
        $response = new \Slim\Psr7\Response();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}
