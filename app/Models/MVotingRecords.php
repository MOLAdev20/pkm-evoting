<?php

namespace App\Models;

use CodeIgniter\Model;

class MVotingRecords extends Model
{
    protected $table            = 'voting_records';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'group_id',
        'participant_id',
        'created_at',
    ];
}
