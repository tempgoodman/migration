package main

import (
	"migration/controllers"
	"migration/models"
	"net/http"

	"github.com/gin-gonic/gin"
)

func main() {
	r := gin.Default()

	db := models.ConnectDatabase()
	db.AutoMigrate(&models.Application{}, &models.AutoPay{}, &models.Customer{}, &models.CustomerCareer{}, &models.OtherInformation{}, &models.Session{})

	r.GET("/", func(c *gin.Context) {
		c.JSON(http.StatusOK, gin.H{"data": "hello world"})
	})
	r.GET("/migrate", controllers.GetSession)

	//r.GET("/books", controllers.FindBooks)
	// r.GET("/books/:id", controllers.FindBook)
	r.POST("/migrate/:id", controllers.CreateCookie)

	r.POST("/loan/:id", controllers.MigrateLoan)
	// r.PATCH("/books/:id", controllers.UpdateBook)
	// r.DELETE("/books/:id", controllers.DeleteBook)

	r.Run()
}
