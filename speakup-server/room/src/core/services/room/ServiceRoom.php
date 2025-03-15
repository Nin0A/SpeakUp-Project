<?php

namespace room\core\services\room;

use room\infra\models\Room;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Capsule\Manager as DB;
use Exception;

class ServiceRoom
{
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Crée une nouvelle salle.
     *
     * @param array $data Les données de la salle à créer.
     * @return Room Le modèle de la salle créée.
     * @throws Exception En cas d'erreur lors de la création.
     */
    public function createRoom(array $data): Room
    {
        try {
            // Générer un UUID pour room_id
            $data['room_id'] = Uuid::uuid4()->toString();

            // Créer une nouvelle salle
            $room = Room::create($data);
            return $room;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la création de la salle : ' . $e->getMessage());
        }
    }

    /**
     * Récupère une salle par son ID.
     *
     * @param string $roomId L'ID de la salle à récupérer.
     * @return Room|null Le modèle de la salle ou null si non trouvée.
     */
    public function getRoomById(string $roomId): ?Room
    {
        return Room::find($roomId);
    }

    /**
     * Met à jour une salle existante.
     *
     * @param string $roomId L'ID de la salle à mettre à jour.
     * @param array $data Les nouvelles données de la salle.
     * @return Room Le modèle de la salle mise à jour.
     * @throws Exception En cas d'erreur lors de la mise à jour.
     */
    public function updateRoom(string $roomId, array $data): Room
    {
        try {
            $room = Room::findOrFail($roomId);
            $room->update($data);
            return $room;
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la mise à jour de la salle : ' . $e->getMessage());
        }
    }

    /**
     * Supprime une salle par son ID.
     *
     * @param string $roomId L'ID de la salle à supprimer.
     * @return bool True si la suppression a réussi, false sinon.
     * @throws Exception En cas d'erreur lors de la suppression.
     */
    public function deleteRoom(string $roomId): bool
    {
        try {
            $room = Room::findOrFail($roomId);
            return $room->delete();
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la suppression de la salle : ' . $e->getMessage());
        }
    }
}
