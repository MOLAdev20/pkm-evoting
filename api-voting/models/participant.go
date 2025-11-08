package models

import "time"

type Participant struct {
	ID        int       `json:"id" gorm:"primary_key;autoIncrement"`
	Fullname  string    `json:"fullname"`
	Username  string    `json:"username"`
	Password  string    `json:"password"`
	UserType  string    `json:"user_type"`
	CreatedAt time.Time `json:"created_at" gorm:"default:current_timestamp"`
	Votings   []Voting  `json:"votings"`
}
