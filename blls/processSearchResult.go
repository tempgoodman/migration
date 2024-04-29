package blls

import (
	"bytes"
	"fmt"
	"io/ioutil"
	"net/http"
	"net/url"
	"strconv"
	"strings"

	"github.com/PuerkitoBio/goquery"
)

func GetLoanSearchResult(login_branch string, login_user string, sessionId string, user_lang string, domain string) *[]int {
	page := []int{}
	ids := []int{}
	targeturl := "https://" + domain + "/nobility_asset_limited/~/search_loan.php?type=view&do=inquire&state=search"
	//targeturl := "https://" + domain + "/nobility_asset_limited/~/search_loan.php?type=view&do=inquire&state=search&page=2"

	formData := url.Values{}
	formData.Set("search_sorting_order", "desc")
	formData.Set("isAjax", "true")
	body := bytes.NewBufferString(formData.Encode())
	req, err := http.NewRequest("POST", targeturl, body)
	if err != nil {
		fmt.Println("Error creating request:", err)
		return &page
	}
	req.Header.Set("Content-Type", "application/x-www-form-urlencoded")

	cookies := []*http.Cookie{
		{Name: "PHPSESSID", Value: sessionId},
		{Name: "login_branch", Value: login_branch},
		{Name: "login_user", Value: login_user},
		{Name: "user_lang", Value: user_lang},
	}

	for _, cookie := range cookies {
		req.AddCookie(cookie)
	}

	resp, err := http.DefaultClient.Do(req)
	if err != nil {
		return &page
	}
	if err != nil {
		fmt.Println("Error sending request:", err)
		return &page
	}
	defer resp.Body.Close()

	fmt.Println("Response Status:", resp.Status)
	respBody, err := ioutil.ReadAll(resp.Body)
	if err != nil {
		fmt.Println("Error reading response body:", err)
		return &page
	}
	htmlContent := string(string(respBody))

	// content, err := ioutil.ReadFile("example_response/search_result.html")
	// //content, err := ioutil.ReadFile("repay.php")
	// if err != nil {
	// }

	page = *ProcessLoanSearchResult(string(htmlContent))

	for _, id := range page {
		fmt.Println("id  Error reading response body:", id)
		targeturl := fmt.Sprint("https://"+domain+"/nobility_asset_limited/~/search_loan.php?type=view&do=inquire&state=search&page=", id)

		formData := url.Values{}
		formData.Set("search_sorting_order", "desc")
		formData.Set("isAjax", "true")
		body := bytes.NewBufferString(formData.Encode())
		req, err := http.NewRequest("POST", targeturl, body)
		if err != nil {
			fmt.Println("Error creating request:", err)
			return &page
		}
		req.Header.Set("Content-Type", "application/x-www-form-urlencoded")

		cookies := []*http.Cookie{
			{Name: "PHPSESSID", Value: sessionId},
			{Name: "login_branch", Value: login_branch},
			{Name: "login_user", Value: login_user},
			{Name: "user_lang", Value: user_lang},
		}

		for _, cookie := range cookies {
			req.AddCookie(cookie)
		}

		resp, err := http.DefaultClient.Do(req)
		if err != nil {
			return &page
		}
		if err != nil {
			fmt.Println("Error sending request:", err)
			return &page
		}
		defer resp.Body.Close()

		fmt.Println("Response Status:", resp.Status)
		respBody, err := ioutil.ReadAll(resp.Body)
		if err != nil {
			fmt.Println("Error reading response body:", err)
			return &page
		}
		htmlContent := string(string(respBody))
		//content, err := ioutil.ReadFile("example_response/search_result.html")
		//content, err := ioutil.ReadFile("repay.php")
		//if err != nil {
		//}
		loanIds := *ProcessLoanSearchResultByPage(string(htmlContent))

		ids = append(ids, loanIds...)
	}
	return &ids
}

func ProcessLoanSearchResult(htmlContent string) *[]int {
	page := []int{}
	// fmt.Println(htmlContent)

	doc, err := goquery.NewDocumentFromReader(strings.NewReader(htmlContent))
	if err != nil {
		fmt.Println("Error reading response body:", err)
		return &page
	}

	selectedOptions := doc.Find("option")

	selectedOptions.Each(func(i int, d *goquery.Selection) {
		// 	fmt.Println("Page :", d.Text())
		num, err := strconv.Atoi(d.Text())
		if err != nil {
			fmt.Println("Error:", err)
			return
		}
		page = append(page, num)
	})
	return &page
}

func ProcessLoanSearchResultByPage(htmlContent string) *[]int {
	page := []int{}
	// fmt.Println(htmlContent)
	doc, err := goquery.NewDocumentFromReader(strings.NewReader(htmlContent))
	if err != nil {
		fmt.Println("Error reading response body:", err)
		return &page
	}
	selectedOptions := doc.Find("input[name='select_choice']")
	selectedOptions.Each(func(i int, d *goquery.Selection) {
		inputValue := d.AttrOr("value", "")
		// fmt.Println("Page :", inputValue)
		num, err := strconv.Atoi(inputValue)
		if err != nil {
			fmt.Println("Error:", err)
			return
		}
		page = append(page, num)
	})
	return &page
}
