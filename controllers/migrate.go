package controllers

import (
	"bytes"
	"crypto/md5"
	"encoding/hex"
	"fmt"
	"io/ioutil"
	"log"
	"migration/models"
	"net/http"
	"net/url"

	"github.com/gin-gonic/gin"
)

type CreateBookInput struct {
	Title  string `json:"title" binding:"required"`
	Author string `json:"author" binding:"required"`
}

type UserAndPass struct {
	UserName string `json:"username"`
	Password string `json:"password"`
	Captcha  string `json:"captcha"`
}

type UpdateBookInput struct {
	Title  string `json:"title"`
	Author string `json:"author"`
}

func GetSession(c *gin.Context) {
	domain := c.Query("domain")
	url := "https://" + domain + "/nobility_asset_limited/~/login.php?type=load_captcha"

	// Create a new HTTP GET request
	req, err := http.NewRequest("GET", url, nil)
	if err != nil {
		fmt.Println("Error creating request:", err)
		return
	}
	client := &http.Client{}

	// Send the request
	resp, err := client.Do(req)
	if err != nil {
		fmt.Println("Error sending request:", err)
		return
	}
	defer resp.Body.Close()

	body, err := ioutil.ReadAll(resp.Body)
	if err != nil {
		fmt.Println("Error reading response body:", err)
		return
	}
	fmt.Println("Response Body:", string(body))

	cookies := resp.Cookies()
	session := models.Session{}
	for _, cookie := range cookies {
		if cookie.Name == "PHPSESSID" {
			session.SessionID = cookie.Value
			session.Domain = domain
			session.CapchartURL = string(body)
			models.DB.Create(&session)
		}
	}

	fmt.Println("Response Status:", resp.Status)

	c.JSON(http.StatusOK, gin.H{"image": string(body), "PHPSESSID": string(session.SessionID)})
	return
}

func CreateCookie(c *gin.Context) {
	sessionId := c.Param("id")
	var requestJSON UserAndPass
	var session models.Session

	if err := c.BindJSON(&requestJSON); err != nil {
		log.Println("Failed to bind JSON:", err)
		c.JSON(400, gin.H{"error": "Failed to parse JSON"})
		return
	}

	if err := models.DB.Where("session_id = ?", sessionId).First(&session).Error; err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Record not found!"})
		return
	}

	hash := md5.Sum([]byte(string(requestJSON.Password)))
	hashString := hex.EncodeToString(hash[:])

	formData := url.Values{}
	formData.Set("username", requestJSON.UserName)
	formData.Set("password_md5", hashString)
	formData.Set("captcha", requestJSON.Captcha)
	formData.Set("isAjax", "true")
	body := bytes.NewBufferString(formData.Encode())

	// Create a new POST request with form data
	req, err := http.NewRequest("POST", "https://"+session.Domain+"/nobility_asset_limited/~/login.php?type=login", body)
	if err != nil {
		// Handle error
		return
	}
	req.Header.Set("Content-Type", "application/x-www-form-urlencoded")

	cookies := []*http.Cookie{
		{Name: "PHPSESSID", Value: sessionId},
		// Add more cookies as needed
	}
	for _, cookie := range cookies {
		req.AddCookie(cookie)
	}

	// Send the request using the default client
	resp, err := http.DefaultClient.Do(req)
	if err != nil {
		// Handle error
		return
	}
	defer resp.Body.Close()

	resCookies := resp.Cookies()
	var user_lang string
	var login_branch string
	var login_user string

	for _, cookie := range resCookies {
		fmt.Printf("Name: %s, Value: %s\n", cookie.Name, cookie.Value)
		if cookie.Name == "login_user" {
			login_user = cookie.Value
		} else if cookie.Name == "user_lang" {
			user_lang = cookie.Value
		} else if cookie.Name == "login_branch" {
			login_branch = cookie.Value
		}
	}

	fmt.Println("Response Status:", resp.Status)

	models.DB.Where("session_id = ?", sessionId).Updates(models.Session{Login_branch: login_branch, Login_user: login_user, User_lang: user_lang, Username: requestJSON.UserName, HashString: hashString})

	c.JSON(http.StatusOK, gin.H{"status": "all good"})
	return
}

/*
// GET /books
// Find all books
func FindBooks(c *gin.Context) {
	var books []models.Book
	models.DB.Find(&books)

	c.JSON(http.StatusOK, gin.H{"data": books})
}



// GET /books/:id
// Find a book
func FindBook(c *gin.Context) {
	// Get model if exist
	var book models.Book
	if err := models.DB.Where("id = ?", c.Param("id")).First(&book).Error; err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Record not found!"})
		return
	}

	c.JSON(http.StatusOK, gin.H{"data": book})
}

// POST /books
// Create new book
func CreateBook(c *gin.Context) {
	// Validate input
	var input CreateBookInput
	if err := c.ShouldBindJSON(&input); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	// Create book
	book := models.Book{Title: input.Title, Author: input.Author}
	models.DB.Create(&book)

	c.JSON(http.StatusOK, gin.H{"data": book})
}

// PATCH /books/:id
// Update a book
func UpdateBook(c *gin.Context) {
	// Get model if exist
	var book models.Book
	if err := models.DB.Where("id = ?", c.Param("id")).First(&book).Error; err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Record not found!"})
		return
	}

	// Validate input
	var input UpdateBookInput
	if err := c.ShouldBindJSON(&input); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	models.DB.Model(&book).Updates(input)

	c.JSON(http.StatusOK, gin.H{"data": book})
}

// DELETE /books/:id
// Delete a book
func DeleteBook(c *gin.Context) {
	// Get model if exist
	var book models.Book
	if err := models.DB.Where("id = ?", c.Param("id")).First(&book).Error; err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Record not found!"})
		return
	}

	models.DB.Delete(&book)

	c.JSON(http.StatusOK, gin.H{"data": true})
}
*/
