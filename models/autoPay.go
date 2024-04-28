package models

import (
	"github.com/google/uuid"
)

type AutoPay struct {
	Id                   uuid.UUID `json:"id" gorm:"primaryKey;type:uuid;default:uuid_generate_v4()"`
	Autopay_ref_no       string    `json:"autopay_ref_no"`
	Autopay_bank         string    `json:"autopay_bank"`
	Autopay_account_name string    `json:"autopay_account_name"`
	Autopay_bank_code    string    `json:"loan_autopay_bank_codeno"`
	Autopay_branch_code  string    `json:"autopay_branch_code"`
	Autopay_account_no   string    `json:"autopay_account_no"`
}
