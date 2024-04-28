package models

import (
	"github.com/google/uuid"
)

type Customer struct {
	Id                          uuid.UUID `json:"id" gorm:"primaryKey;type:uuid;default:uuid_generate_v4()"`
	Name                        string    `json:"name"`
	Customer_type               string    `json:"customer_type"`
	Director_name               string    `json:"director_name"`
	Birth_date                  string    `json:"birth_date"`
	Age                         string    `json:"age"`
	Passport_no                 string    `json:"passport_no"`
	Mobile_no                   string    `json:"mobile_no"`
	Mobile_no2                  string    `json:"mobile_no2"`
	Mobile_no3                  string    `json:"mobile_no3"`
	Home_no                     string    `json:"home_no"`
	Email                       string    `json:"email"`
	Marital_status              string    `json:"marital_status"`
	Education                   string    `json:"education"`
	Flat_address                string    `json:"flat_address"`
	Flat_address_district_id    string    `json:"flat_address_district_id"`
	Mailing_address             string    `json:"mailing_address"`
	Mailing_address_district_id string    `json:"mailing_address_district_id"`
	Flat_type_id                string    `json:"flat_type_id"`
	Gender                      string    `json:"gender"`
	Customer_career_id          uuid.UUID `json:"customer_career_id"`
}
