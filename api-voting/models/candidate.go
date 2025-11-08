package models

import "time"

type Candidate struct {
	ID          int       `json:"id" gorm:"primary_key;autoIncrement"`
	Name        string    `json:"name"`
	Photo       string    `json:"photo"`
	ClassName   string    `json:"class_name"`
	OrderNumber int       `json:"order_number"`
	Vision      string    `json:"vision"`
	Mission     string    `json:"mission"`
	CreatedAt   time.Time `json:"created_at" gorm:"default:current_timestamp"`
	Votings     []Voting  `json:"votings"`
}
