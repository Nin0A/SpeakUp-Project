<?php

namespace auth\core\services\auth;

use auth\infra\models\Credential;
use auth\infra\models\Role;
use Ramsey\Uuid\Uuid;
use Exception;
use Illuminate\Support\Facades\Hash;

class ServiceAuth
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Enregistre un nouvel utilisateur.
     *
     * @param array $data Les données de l'utilisateur à enregistrer.
     * @return Credential Les informations d'identification de l'utilisateur enregistré.
     * @throws Exception En cas d'erreur lors de l'enregistrement.
     */
    public function registerUser(array $data): Credential
    {
        try {

            // Générer un UUID pour user_id
            $userId = Uuid::uuid4()->toString();

            // Hasher le mot de passe
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

            // Trouver ou créer le rôle par défaut
            $role = Role::firstOrCreate(['label' => 'user'], ['label' => 'user']);

            // Créer les informations d'identification
            $credential = Credential::create([
                'user_id' => $userId,
                'email' => $data['email'],
                'password_hash' => $hashedPassword,
                'role_id' => $role->role_id,
            ]);

            return $credential;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de l\'enregistrement de l\'utilisateur : ' . $e->getMessage());
        }
    }

    /**
     * Connecte un utilisateur.
     *
     * @param string $email L'email de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     * @return Credential|null Les informations d'identification de l'utilisateur connecté ou null si les informations d'identification sont incorrectes.
     */
    public function loginUser(string $email, string $password): ?Credential
    {
        $credential = Credential::where('email', $email)->first();

        if ($credential && password_verify($password, $credential->password_hash)) {
            return $credential;
        }


        return null;
    }
}
