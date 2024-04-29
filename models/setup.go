package models

import (
	"fmt"

	"github.com/joho/godotenv"
	"gorm.io/driver/postgres"
	"gorm.io/gorm"
)

var DB *gorm.DB

func ConnectDatabase() *gorm.DB {

	err := godotenv.Load() //by default, it is .env so we don't have to write
	if err != nil {
		fmt.Println("Error is occurred  on .env file please check")
	}
	//we read our .env file
	//host := os.Getenv("HOST")
	// port, _ := strconv.Atoi(os.Getenv("DBPORT")) // don't forget to convert int since port is int type.
	// user := os.Getenv("USER")
	// dbname := os.Getenv("DB_NAME")
	// pass := os.Getenv("PASSWORD")
	dsn := fmt.Sprintf("host=%s port=%d user=%s dbname=%s password=%s sslmode=disable",
		//	host, port, user, dbname, pass)
		"localhost", 5432, "postgres", "migration", "password")
	db, err := gorm.Open(postgres.Open(dsn), &gorm.Config{})
	if err != nil {
		fmt.Sprintf("Failed to connect to database:")
	}
	DB = db
	return db
}
