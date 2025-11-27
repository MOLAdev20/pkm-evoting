<?php

namespace App\Models;

use CodeIgniter\Model;

class MParticipant extends Model
{
    protected $table            = 'participant';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id",
        "nisn",
        "name",
        "gender",
        "class",
        "username",
        "password",
        "created_at",
        "updated_at"
    ];
}
