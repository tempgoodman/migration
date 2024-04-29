package controllers

import (
	"migration/blls"
	"migration/models"
	"net/http"

	"github.com/gin-gonic/gin"
)

func MigrateLoan(c *gin.Context) {
	sessionId := c.Param("id")
	var session models.Session

	if err := models.DB.Where("session_id = ?", sessionId).First(&session).Error; err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Record not found!"})
		return
	}
	//ids := blls.GetLoanSearchResult(session.Login_branch, session.Login_user, sessionId, session.User_lang, session.Domain)
	blls.GetLoan("126", session.Login_branch, session.Login_user, sessionId, session.User_lang, session.Domain)
	// for _, id := range *ids {
	// 	fmt.Println("Checked Radio Value:", id)
	// 	blls.GetLoan(string(id), session.Login_branch, session.Login_user, sessionId, session.User_lang, session.Domain)
	// }
	c.JSON(http.StatusOK, gin.H{"status": "all good"})
}
