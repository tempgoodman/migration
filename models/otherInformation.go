package models

import (
	"github.com/google/uuid"
)

type OtherInformation struct {
	Id               uuid.UUID `json:"id" gorm:"primaryKey;type:uuid;default:uuid_generate_v4()"`
	Source_id        string    `json:"source_id"`
	Source_remark    string    `json:"source_remarkstring"`
	Decline_loan_log string    `json:"decline_loan_log"`
	Remark           string    `json:"remark"`
}
