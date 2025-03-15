<?php

namespace auth\infra\models;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $table = 'credentials';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['user_id', 'email', 'password_hash', 'role_id'];

    // Relation avec le rôle
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
