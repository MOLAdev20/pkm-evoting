<?php

namespace App\Models;

use CodeIgniter\Model;

class MCandidateGroup extends Model
{
    protected $table            = 'candidate_group';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "cp_id",
        "vcp_id",
        "alias",
        "vision",
        "mission",
        "theme",
        "created_at",
        "updated_at"
    ];
}
