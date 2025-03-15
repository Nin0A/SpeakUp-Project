<?php

namespace room\core\services\room;

use room\infra\models\Member;
use Illuminate\Database\Capsule\Manager as DB;
use Exception;

class ServiceMember
{
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Ajoute un membre à une salle.
     *
     * @param string $roomId L'ID de la salle.
     * @param string $userId L'ID de l'utilisateur.
     * @param string $role Le rôle du membre.
     * @return Member Le modèle du membre ajouté.
     * @throws Exception En cas d'erreur lors de l'ajout.
     */
    public function addMemberToRoom(string $roomId, string $userId, string $role): Member
    {
        try {
            $member = new Member(['user_id' => $userId, 'room_id' => $roomId, 'role' => $role]);
            $member->save();
            return $member;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de l\'ajout du membre à la salle : ' . $e->getMessage());
        }
    }

    /**
     * Supprime un membre d'une salle.
     *
     * @param string $roomId L'ID de la salle.
     * @param string $userId L'ID de l'utilisateur.
     * @return bool True si la suppression a réussi, false sinon.
     * @throws Exception En cas d'erreur lors de la suppression.
     */
    public function removeMemberFromRoom(string $roomId, string $userId): bool
    {
        try {
            $member = Member::where('room_id', $roomId)->where('user_id', $userId)->firstOrFail();
            return $member->delete();
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la suppression du membre de la salle : ' . $e->getMessage());
        }
    }
}
