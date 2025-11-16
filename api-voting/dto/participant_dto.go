package dto

type Participant struct {
	ID        int                    `json:"id"`
	Fullname  string                 `json:"fullname"`
	Username  string                 `json:"username"`
	Password  string                 `json:"password"`
	UserType  string                 `json:"user_type"`
	CreatedAt string                 `json:"created_at"`
	Votings   []VotingForParticipant `json:"votings"`
}

type VotingForParticipant struct {
	ID          int         `json:"id"`
	Participant Participant `json:"participant"`
	Reason      string      `json:"reason"`
	CreatedAt   string      `json:"created_at"`
}
