package controllers

import (
	"fmt"
	"io/ioutil"
	"log"
	"migration/models"
	"net/http"
	"strings"

	"github.com/PuerkitoBio/goquery"
	"github.com/gin-gonic/gin"
	"golang.org/x/net/html"
)

func MigrateLoan(c *gin.Context) {
	sessionId := c.Param("id")
	var session models.Session
	if err := models.DB.Where("session_id = ?", sessionId).First(&session).Error; err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Record not found!"})
		return
	}
	getLoan("126", session.Login_branch, session.Login_user, sessionId, session.User_lang, session.Domain)

	c.JSON(http.StatusOK, gin.H{"status": "all good"})
}

func getLoan(loanId string, login_branch string, login_user string, sessionId string, user_lang string, domain string) {
	url := "https://" + domain + "/nobility_asset_limited/~/loan_info.php?id=" + loanId

	// Create a new HTTP GET request
	req, err := http.NewRequest("GET", url, nil)
	if err != nil {
		fmt.Println("Error creating request:", err)
		return
	}

	// Set multiple cookies if needed

	cookies := []*http.Cookie{
		{Name: "PHPSESSID", Value: sessionId},
		{Name: "login_branch", Value: login_branch},
		{Name: "login_user", Value: login_user},
		{Name: "user_lang", Value: user_lang},
	}

	for _, cookie := range cookies {
		req.AddCookie(cookie)
	}

	// Create an HTTP client
	client := &http.Client{}

	// Send the request
	resp, err := client.Do(req)
	if err != nil {
		fmt.Println("Error sending request:", err)
		return
	}
	defer resp.Body.Close()

	// Print the response status code
	fmt.Println("Response Status:", resp.Status)

	// Read and print the response body
	body, err := ioutil.ReadAll(resp.Body)
	if err != nil {
		fmt.Println("Error reading response body:", err)
		return
	}
	// fmt.Println("Response Body:", string(body))
	// body1, err := html.Parse(strings.NewReader(string(body)))

	// if body != nil {
	// 	// Print the content of the head element
	// 	printNodeContent(body1)
	// }

	htmlContent := string(string(body))
	doc, err := goquery.NewDocumentFromReader(strings.NewReader(htmlContent))
	if err != nil {
		log.Fatal(err)
	}

	input1 := doc.Find("#upload_loan_log_at")

	// Get the value attribute of the input element
	value1, exists := input1.Attr("value")
	if exists {
		fmt.Println("Value of input #upload_loan_log_at:", value1)
	} else {
		fmt.Println("Value attribute not found for input #upload_loan_log_at")
	}

	checkedCheckboxes := doc.Find("input[type='checkbox']:checked")

	// Iterate over the matched checked checkboxes
	checkedCheckboxes.Each(func(i int, s *goquery.Selection) {
		// Get the value attribute of the checked checkbox
		value, exists := s.Attr("id")
		if exists {
			fmt.Printf("Checked Checkbox Value: %s\n", value)
		}
	})

	checkedRadio := doc.Find("input[type='radio']:checked")

	// Get the value attribute of the checked radio button
	value, exists := checkedRadio.Attr("id")
	if exists {
		fmt.Println("Checked Radio Value:", value)
	} else {
		fmt.Println("No radio button checked")
	}

	labels := doc.Find("label")

	// Find all <td> elements within the <table>
	// body.Find("table td").Each(func(i int, s *goquery.Selection) {
	// 	// Get the text content of the <td> element
	// 	text := s.Text()

	// 	fmt.Printf("Cell %d: %s\n", i+1, text)
	// })
	labels.Each(func(i int, s *goquery.Selection) {
		// Get the value of the "for" attribute of the <label> element
		forAttr, exists := s.Attr("for")
		if !exists {
			return // Skip if the "for" attribute doesn't exist
		}

		// Find the <input> element associated with the <label> by its "id" attribute
		input := doc.Find("#" + forAttr)

		// Get the value of the "id" attribute of the <input> element
		inputID, exists := input.Attr("id")

		// var inputValue string
		// inputValue = input.AttrOr("value", "")

		// selectedOptions := input.Find("option[selected]")

		// selectedOptions.Each(func(i int, d *goquery.Selection) {
		// 	// Get the text content of the <option> element
		// 	inputValue = d.Text()
		// 	//fmt.Println("Selected Option:", inputValue)
		// })

		if exists {
			//fmt.Printf("Label: %s, Input ID: %s, Input Value: %s\n", s.Text(), inputID, inputValue)
			fmt.Printf("%s\n", inputID)
		}
	})
}
func findBody(n *html.Node) *html.Node {
	if n.Type == html.ElementNode && n.Data == "head" {
		return n
	}
	for c := n.FirstChild; c != nil; c = c.NextSibling {
		if res := findBody(c); res != nil {
			return res
		}
	}
	return nil
}

// printNodeContent prints the content of the HTML node
func printNodeContent(n *html.Node) {
	for c := n.FirstChild; c != nil; c = c.NextSibling {
		if c.Type == html.TextNode {
			fmt.Println(c.Data)
		}
	}
}
