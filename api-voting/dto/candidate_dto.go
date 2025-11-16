package dto

import "time"

type VotingForCandidate struct {
	ID          int         `json:"id"`
	Participant Participant `json:"participant"`
	Reason      string      `json:"reason"`
	CreatedAt   time.Time   `json:"created_at"`
}

// DTO untuk data kandidat dan pemilihnya
type Candidate struct {
	ID          int                `json:"id"`
	Name        string             `json:"name"`
	Photo       string             `json:"photo"`
	ClassName   string             `json:"class_name"`
	OrderNumber int                `json:"order_number"`
	Vision      string             `json:"vision"`
	Mission     string             `json:"mission"`
	CreatedAt   time.Time          `json:"created_at"`
	Voters      VotingForCandidate `json:"voters"`
}
