<?php

namespace room\infra\models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['user_id', 'room_id', 'role'];

    // Relation plusieurs-à-plusieurs avec les salles via la table pivot room_members
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_members', 'user_id', 'room_id')
                    ->withTimestamps();
    }

    // Relation avec la salle (propriétaire)
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
}
