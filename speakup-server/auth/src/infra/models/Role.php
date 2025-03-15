<?php

namespace auth\infra\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['label'];

    // Relation avec les informations d'identification
    public function credentials()
    {
        return $this->hasMany(Credential::class, 'role_id', 'role_id');
    }
}
