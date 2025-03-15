<?php

namespace auth\core\providers;

use auth\core\services\auth\ServiceAuth;
use auth\infra\models\Credential;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PasswordAuthProvider implements AuthProviderInterface
{
    private $authService;
    private $jwtSecret;

    public function __construct(ServiceAuth $authService, string $jwtSecret)
    {
        $this->authService = $authService;
        $this->jwtSecret = $jwtSecret;
    }

    public function authenticate(array $credentials): ?string
    {
        try {
            // Authentifier l'utilisateur
            $credential = $this->authService->loginUser($credentials['email'], $credentials['password']);

            if ($credential) {
                // Générer un JWT
                return $this->generateJwt($credential);
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw new Exception('Erreur lors de l\'authentification : ' . $e->getMessage());
        }
    }

    private function generateJwt($credential): string
    {
        $payload = [
            'user_id' => $credential->user_id,
            'email' => $credential->email,
            'iat' => time(), // Issued at
            'exp' => time() + (60 * 60 * 24) // Expiration time: 1 day
        ];

        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }
}
