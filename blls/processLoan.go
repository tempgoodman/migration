package blls

import (
	"fmt"
	"io/ioutil"
	"log"
	"migration/models"
	"reflect"
	"strings"

	"github.com/PuerkitoBio/goquery"
	"github.com/google/uuid"
)

func setFieldValue(ogp *models.Application, field string, value string) {
	r := reflect.ValueOf(ogp)
	f := reflect.Indirect(r).FieldByName(field)
	if f.Kind() != reflect.Invalid {
		f.SetString(value)
	}
}

func GetLoan(loanId string, login_branch string, login_user string, sessionId string, user_lang string, domain string) {
	// url := "https://" + domain + "/nobility_asset_limited/~/loan_info.php?id=" + loanId

	// // Create a new HTTP GET request
	// req, err := http.NewRequest("GET", url, nil)
	// if err != nil {
	// 	fmt.Println("Error creating request:", err)
	// 	return
	// }

	// // Set multiple cookies if needed

	// cookies := []*http.Cookie{
	// 	{Name: "PHPSESSID", Value: sessionId},
	// 	{Name: "login_branch", Value: login_branch},
	// 	{Name: "login_user", Value: login_user},
	// 	{Name: "user_lang", Value: user_lang},
	// }

	// for _, cookie := range cookies {
	// 	req.AddCookie(cookie)
	// }

	// // Create an HTTP client
	// client := &http.Client{}

	// // Send the request
	// resp, err := client.Do(req)
	// if err != nil {
	// 	fmt.Println("Error sending request:", err)
	// 	return
	// }
	// defer resp.Body.Close()

	// // Print the response status code
	// fmt.Println("Response Status:", resp.Status)

	// // Read and print the response body
	// body, err := ioutil.ReadAll(resp.Body)
	// if err != nil {
	// 	fmt.Println("Error reading response body:", err)
	// 	return
	// }
	// fmt.Println("Response Body:", string(body))
	// body1, err := html.Parse(strings.NewReader(string(body)))

	// if body != nil {
	// 	// Print the content of the head element
	// 	printNodeContent(body1)
	// }

	//htmlContent := string(string(body))
	content, err := ioutil.ReadFile("example_response/loan_info.html")
	if err != nil {
	}
	Process(string(content))
}

func Process(htmlContent string) {
	// doc, err := goquery.NewDocumentFromReader(strings.NewReader(htmlContent))
	// if err != nil {
	// 	log.Fatal(err)
	// }

	// input1 := doc.Find("#upload_loan_log_at")

	// // Get the value attribute of the input element
	// value1, exists := input1.Attr("value")
	// if exists {
	// 	fmt.Println("Value of input #upload_loan_log_at:", value1)
	// } else {
	// 	fmt.Println("Value attribute not found for input #upload_loan_log_at")
	// }

	// checkedCheckboxes := doc.Find("input[type='checkbox']:checked")

	// // Iterate over the matched checked checkboxes
	// checkedCheckboxes.Each(func(i int, s *goquery.Selection) {
	// 	// Get the value attribute of the checked checkbox
	// 	value, exists := s.Attr("id")
	// 	if exists {
	// 		fmt.Printf("Checked Checkbox Value: %s\n", value)
	// 	}
	// })

	// checkedRadio := doc.Find("input[type='radio']:checked")

	// // Get the value attribute of the checked radio button
	// value, exists := checkedRadio.Attr("id")
	// if exists {
	// 	fmt.Println("Checked Radio Value:", value)
	// } else {
	// 	fmt.Println("No radio button checked")
	// }

	// labels := doc.Find("label")

	// // Find all <td> elements within the <table>
	// // body.Find("table td").Each(func(i int, s *goquery.Selection) {
	// // 	// Get the text content of the <td> element
	// // 	text := s.Text()

	// // 	fmt.Printf("Cell %d: %s\n", i+1, text)
	// // })
	// labels.Each(func(i int, s *goquery.Selection) {
	// 	// Get the value of the "for" attribute of the <label> element
	// 	forAttr, exists := s.Attr("for")
	// 	if !exists {
	// 		return // Skip if the "for" attribute doesn't exist
	// 	}

	// 	// Find the <input> element associated with the <label> by its "id" attribute
	// 	input := doc.Find("#" + forAttr)

	// 	// Get the value of the "id" attribute of the <input> element
	// 	inputID, exists := input.Attr("id")

	// 	var inputValue string
	// 	inputValue = input.AttrOr("value", "")

	// 	selectedOptions := input.Find("option[selected]")

	// 	selectedOptions.Each(func(i int, d *goquery.Selection) {
	// 		// Get the text content of the <option> element
	// 		inputValue = d.Text()
	// 		//fmt.Println("Selected Option:", inputValue)
	// 	})

	// 	if exists {
	// 		fmt.Printf("Label: %s, Input ID: %s, Input Value: %s\n", s.Text(), inputID, inputValue)
	// 		//fmt.Printf("%s\n", inputID)
	// 	}
	// })

	var application models.Application
	var customer models.Customer
	var autopay models.AutoPay
	var otherInformation models.OtherInformation
	var customerCareer models.CustomerCareer

	doc, err := goquery.NewDocumentFromReader(strings.NewReader(htmlContent))
	if err != nil {
		log.Fatal(err)
	}
	t := reflect.TypeOf(application)
	for i := 0; i < t.NumField(); i++ {
		field := t.Field(i)
		fieldName := field.Name
		input := doc.Find("#" + strings.ToLower(fieldName))
		inputValue := input.AttrOr("value", "")

		selectedOptions := input.Find("option[selected]")
		selectedOptions.Each(func(i int, d *goquery.Selection) {
			// Get the text content of the <option> element
			inputValue = d.Text()
			fmt.Println("Selected Option:", inputValue)
		})

		if fieldName != "ID" && fieldName != "Customer_id" && fieldName != "Autopay" && fieldName != "Customer_career_id" && fieldName != "Other_information" {
			fmt.Println("Field 'Name' not found ", fieldName)
			setFieldValue(&application, fieldName, inputValue)
		}
	}
	application.ID = uuid.New()

	t2 := reflect.TypeOf(customer)
	for i := 0; i < t2.NumField(); i++ {
		field := t2.Field(i)
		fieldName := field.Name
		input := doc.Find("#" + strings.ToLower(fieldName))
		inputValue := input.AttrOr("value", "")

		selectedOptions := input.Find("option[selected]")
		selectedOptions.Each(func(i int, d *goquery.Selection) {
			// Get the text content of the <option> element
			inputValue = d.Text()
			fmt.Println("Selected Option:", inputValue)
		})

		if fieldName != "Id" && fieldName != "Customer_career_id" {
			fmt.Println("Field 'Name' not found ", fieldName)
			setFieldValue1(&customer, fieldName, inputValue)
		}
	}
	customer.Id = uuid.New()

	t3 := reflect.TypeOf(autopay)
	for i := 0; i < t3.NumField(); i++ {
		field := t3.Field(i)
		fieldName := field.Name
		input := doc.Find("#" + strings.ToLower(fieldName))
		inputValue := input.AttrOr("value", "")

		selectedOptions := input.Find("option[selected]")
		selectedOptions.Each(func(i int, d *goquery.Selection) {
			// Get the text content of the <option> element
			inputValue = d.Text()
			fmt.Println("Selected Option:", inputValue)
		})

		if fieldName != "Id" {
			fmt.Println("Field 'Name' not found ", fieldName)
			setFieldValue2(&autopay, fieldName, inputValue)
		}
	}
	autopay.Id = uuid.New()

	t4 := reflect.TypeOf(otherInformation)
	for i := 0; i < t4.NumField(); i++ {
		field := t4.Field(i)
		fieldName := field.Name
		input := doc.Find("#" + strings.ToLower(fieldName))
		inputValue := input.AttrOr("value", "")

		selectedOptions := input.Find("option[selected]")
		selectedOptions.Each(func(i int, d *goquery.Selection) {
			// Get the text content of the <option> element
			inputValue = d.Text()
			fmt.Println("Selected Option:", inputValue)
		})

		if fieldName != "Id" {
			fmt.Println("Field 'Name' not found ", fieldName)
			setFieldValue4(&otherInformation, fieldName, inputValue)
		}
	}
	otherInformation.Id = uuid.New()

	t5 := reflect.TypeOf(customerCareer)
	for i := 0; i < t5.NumField(); i++ {
		field := t5.Field(i)
		fieldName := field.Name
		input := doc.Find("#" + strings.ToLower(fieldName))
		inputValue := input.AttrOr("value", "")

		selectedOptions := input.Find("option[selected]")
		selectedOptions.Each(func(i int, d *goquery.Selection) {
			// Get the text content of the <option> element
			inputValue = d.Text()
			fmt.Println("Selected Option:", inputValue)
		})

		if fieldName != "Id" && fieldName != "Customer_id" && fieldName != "Autopay" && fieldName != "Customer_career_id" && fieldName != "Other_information" {
			fmt.Println("Field 'Name' not found ", fieldName)
			setFieldValue3(&customerCareer, fieldName, inputValue)
		}
	}
	customerCareer.Id = uuid.New()

	customer.Customer_career_id = customerCareer.Id
	application.Customer_career_id = customerCareer.Id
	application.Customer_id = customer.Id
	application.Autopay = autopay.Id
	application.Other_information = otherInformation.Id

	models.DB.Create(&application)
	models.DB.Create(&customerCareer)
	models.DB.Create(&customer)
	models.DB.Create(&autopay)
	models.DB.Create(&otherInformation)

	fmt.Println("application", application)
	fmt.Println("customerCareer", customerCareer)
	fmt.Println("customer", customer)
	fmt.Println("autopay", autopay)
	fmt.Println("otherInformation", otherInformation)
}

func setFieldValue1(ogp *models.Customer, field string, value string) {
	r := reflect.ValueOf(ogp)
	f := reflect.Indirect(r).FieldByName(field)
	if f.Kind() != reflect.Invalid {
		f.SetString(value)
	}
}
func setFieldValue2(ogp *models.AutoPay, field string, value string) {
	r := reflect.ValueOf(ogp)
	f := reflect.Indirect(r).FieldByName(field)
	if f.Kind() != reflect.Invalid {
		f.SetString(value)
	}
}
func setFieldValue3(ogp *models.CustomerCareer, field string, value string) {
	r := reflect.ValueOf(ogp)
	f := reflect.Indirect(r).FieldByName(field)
	if f.Kind() != reflect.Invalid {
		f.SetString(value)
	}
}
func setFieldValue4(ogp *models.OtherInformation, field string, value string) {
	r := reflect.ValueOf(ogp)
	f := reflect.Indirect(r).FieldByName(field)
	if f.Kind() != reflect.Invalid {
		f.SetString(value)
	}
}
