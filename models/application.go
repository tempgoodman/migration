package models

import (
	"github.com/google/uuid"
)

type Application struct {
	ID                        uuid.UUID `json:"id" gorm:"primaryKey;type:uuid;default:uuid_generate_v4()"`
	Loan_no                   string    `json:"loan_no"`
	Model                     string    `json:"model"`
	Apply_no                  string    `json:"apply_no"`
	Loan_status               string    `json:"loan_status"`
	Loan_type_id              string    `json:"loan_type_id"`
	Newloan_no                string    `json:"newloan_no"`
	Repayment_cycle           string    `json:"repayment_cycle"`
	Interest_method           string    `json:"interest_method"`
	Rate_type                 string    `json:"rate_type"`
	Loan_amount               string    `json:"loan_amount"`
	Installment               string    `json:"installment"`
	Prime_rate_vary           string    `json:"prime_rate_vary"`
	Flat_rate                 string    `json:"flat_rate"`
	Interest_rate             string    `json:"interest_rate"`
	Installment_amount        string    `json:"installment_amount"`
	Maxint_max_total_interest string    `json:"maxint_max_total_interest"`
	Maxint_total_interest     string    `json:"maxint_total_interest"`
	Apply_date                string    `json:"apply_date"`
	Loan_purpose_id           string    `json:"loan_purpose_id"`
	Loan_branch               string    `json:"loan_branch"`
	Loan_staff                string    `json:"loan_staff"`
	Agent_id                  string    `json:"agent_id"`
	Agent_address             string    `json:"agent_address"`
	Agent_relation            string    `json:"agent_relation"`
	Main_avenue_id            string    `json:"main_avenue_id"`
	Main_purpose_id           string    `json:"main_purpose_id"`
	Loan_upload               string    `json:"loan_upload"`
	Customer_id               uuid.UUID `json:"customer_id"`
	Autopay                   uuid.UUID `json:"autopay"`
	Customer_career_id        uuid.UUID `json:"customer_career_id"`
	Other_information         uuid.UUID `json:"other_informations"`
}
