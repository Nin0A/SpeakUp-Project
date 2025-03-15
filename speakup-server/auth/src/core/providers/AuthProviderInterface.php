<?php

namespace auth\core\providers;

use auth\infra\models\Credential;
use Exception;

interface AuthProviderInterface
{
    /**
     * Authentifie un utilisateur.
     *
     * @param array $credentials Les informations d'identification fournies.
     * @return Credential|null Les informations d'identification de l'utilisateur authentifié ou null si l'authentification échoue.
     * @throws Exception En cas d'erreur lors de l'authentification.
     */
    public function authenticate(array $credentials): ?string;
}
