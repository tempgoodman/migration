package main

import (
	"migration/database"
	"net/http"

	"github.com/gin-gonic/gin"
)

func main() {
	r := gin.Default()
	database.ConnectDatabase()

	r.GET("/", func(c *gin.Context) {
		c.JSON(http.StatusOK, gin.H{"data": "hello world"})
	})

	// r.GET("/books", controllers.FindBooks)
	// r.GET("/books/:id", controllers.FindBook)
	// r.POST("/books", controllers.CreateBook)
	// r.PATCH("/books/:id", controllers.UpdateBook)
	// r.DELETE("/books/:id", controllers.DeleteBook)

	r.Run()
}
