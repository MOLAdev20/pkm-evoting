package models

import "time"

type Voting struct {
	ID            int         `json:"id" gorm:"primary_key;autoIncrement"`
	CandidateID   int         `json:"candidate_id"`
	Candidate     Candidate   `json:"candidate" gorm:"foreignKey:CandidateID;references:ID"`
	ParticipantID int         `json:"participant_id"`
	Participant   Participant `json:"participant" gorm:"foreignKey:ParticipantID;references:ID"`
	Reason        string      `json:"reason" gorm:"default:'-'"`
	CreatedAt     time.Time   `json:"created_at" gorm:"default:current_timestamp"`
}
