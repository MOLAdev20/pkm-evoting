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
        "election_id",
        "alias",
        "vision",
        "mission",
        "theme",
        "created_at",
        "updated_at"
    ];

    public function getLiveVote()
    {
        $subQuery = $this->db->table('voting_records')
            ->select('group_id, election_id, COUNT(*) AS total_suara')
            ->groupBy('group_id, election_id')
            ->getCompiledSelect();

        return $this->db->table('candidate_group cg')
            ->select('cg.id, cg.alias, COALESCE(vr.total_suara, 0) AS total_suara')
            ->join('election e', 'e.id = cg.election_id AND e.status = "open"', 'inner')
            ->join(
                "({$subQuery}) AS vr",
                'vr.group_id = cg.id AND vr.election_id = cg.election_id',
                'left'
            )
            ->get()
            ->getResult();
    }

    public function getLiveVoteWithCG($electionId)
    {
        $subQuery = $this->db->table('voting_records')
            ->select('group_id, election_id, COUNT(*) AS total_suara')
            ->groupBy('group_id, election_id')
            ->getCompiledSelect();

        return $this->db->table('candidate_group cg')
            ->select([
                'cg.id',
                'cg.alias',
                'cg.vision',
                'cg.mission',
                'cg.election_id',
                'cp.name AS chairperson',
                'vcp.name AS vice_chairperson',
                'cp.photo AS cp_photo',
                'vcp.photo AS vcp_photo',
                'COALESCE(vr.total_suara, 0) AS total_suara',
            ])
            ->join('election e', "e.id = cg.election_id AND e.id = {$electionId}", 'inner')
            ->join("({$subQuery}) AS vr", 'vr.group_id = cg.id AND vr.election_id = cg.election_id', 'left')
            ->join('candidate cp', 'cg.cp_id = cp.id', 'left')
            ->join('candidate vcp', 'cg.vcp_id = vcp.id', 'left')
            ->get()->getResultArray();
    }
}
