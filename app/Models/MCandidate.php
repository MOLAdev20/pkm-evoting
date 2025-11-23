<?php

namespace App\Models;

use CodeIgniter\Model;

class MCandidate extends Model
{
    protected $table            = 'candidate';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "nis",
        "name",
        "gender",
        "birth_date",
        "photo",
        "class",
        "bio",
        "video_url",
        "is_active",
        "created_at",
        "updated_at"
    ];
}
