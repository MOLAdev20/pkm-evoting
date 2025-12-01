<?php

namespace App\Models;

use CodeIgniter\Model;

class MElection extends Model
{
    protected $table            = 'election';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "title",
        "start_at",
        "end_at",
        "status",
        "created_at",
        "updated_at"
    ];
}
