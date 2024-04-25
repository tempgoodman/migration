package main

import (
	"fmt"
	"log"
	"strings"

	"io/ioutil"

	"github.com/PuerkitoBio/goquery"
)

func main() {
	// HTML content to be parsed
	content, err := ioutil.ReadFile("loan_info.html")
	//content, err := ioutil.ReadFile("repay.php")
	if err != nil {
		log.Fatal(err)
	}

	htmlContent := string(content)

	// Convert the byte slice to a string

	// htmlContent := `
	// <html>
	// 	<body>
	// 		<table>
	// 			<tr>
	// 				<td>Cell 1</td>
	// 				<td>Cell 2</td>
	// 			</tr>
	// 			<tr>
	// 				<td>Cell 3</td>
	// 				<td>Cell 4</td>
	// 			</tr>
	// 		</table>
	// 	</body>
	// </html>
	// `

	// Parse the HTML content
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
		var inputValue string
		inputValue = input.AttrOr("value", "")

		selectedOptions := input.Find("option[selected]")

		selectedOptions.Each(func(i int, d *goquery.Selection) {
			// Get the text content of the <option> element
			inputValue = d.Text()
			//fmt.Println("Selected Option:", inputValue)
		})

		if exists {
			fmt.Printf("Label: %s, Input ID: %s, Input Value: %s\n", s.Text(), inputID, inputValue)
		}
	})

}
