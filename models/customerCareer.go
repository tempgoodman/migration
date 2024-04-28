package models

import (
	"github.com/google/uuid"
)

type CustomerCareer struct {
	Id                          uuid.UUID `json:"id" gorm:"primaryKey;type:uuid;default:uuid_generate_v4()"`
	Occupy_from                 string    `json:"occupy_from"`
	Occupy_duration_year        string    `json:"occupy_duration_year"`
	Occupy_with_remark          string    `json:"occupy_with_remark"`
	Company_name                string    `json:"company_name"`
	Company_address             string    `json:"company_address"`
	Company_address_district_id string    `json:"company_address_district_id"`
	Office_no                   string    `json:"office_no"`
	Direct_line_no              string    `json:"direct_line_no"`
	Fax_no                      string    `json:"fax_no"`
	Occupation_id               string    `json:"occupation_id"`
	Industry                    string    `json:"industry"`
	Department                  string    `json:"department"`
	Position                    string    `json:"position"`
	Employment_type             string    `json:"employment_type"`
	Work_from                   string    `json:"work_from"`
	Work_duration_year          string    `json:"work_duration_year"`
	Salary                      string    `json:"salary"`
	Income_proof                string    `json:"income_proof"`
}
