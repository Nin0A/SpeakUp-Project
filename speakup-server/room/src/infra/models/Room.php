<?php

namespace room\infra\models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['room_id', 'name', 'owner_id'];

    // Relation plusieurs-à-plusieurs avec les membres via la table pivot room_members
    public function members()
    {
        return $this->belongsToMany(Member::class, 'room_members', 'room_id', 'user_id')
                    ->withTimestamps();
    }
}
