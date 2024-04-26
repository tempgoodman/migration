package main

import (
	"fmt"
	"io/ioutil"
	"net/http"
	"strings"

	"golang.org/x/net/html"
)

func main() {
	// URL endpoint for the GET request
	url := "https://loan23.softmediahk.com/nobility_asset_limited/~/loan_info.php?id=126"

	// Create a new HTTP GET request
	req, err := http.NewRequest("GET", url, nil)
	if err != nil {
		fmt.Println("Error creating request:", err)
		return
	}

	// Set multiple cookies if needed

	cookies := []*http.Cookie{
		{Name: "PHPSESSID", Value: "6cpp26jqlds9sl10u8tnnaiqg5"},
		{Name: "login_branch", Value: "YTozOntzOjk6ImJyYW5jaF9pZCI7czoxOiIxIjtzOjExOiJicmFuY2hfbmFtZSI7czo2OiJKb3JkYW4iO3M6MTU6ImJyYW5jaF9uYW1lX2NoaSI7czo2OiLkvZDmlaYiO30%3D"},
		{Name: "login_user", Value: "YTo2OntzOjc6InVzZXJfaWQiO3M6MjoiMTUiO3M6ODoidXNlcm5hbWUiO3M6NDoiYm9uZyI7czoxMDoic3RhZmZfY29kZSI7czozOiJTMDkiO3M6MTA6InN0YWZmX25hbWUiO3M6NDoiYm9uZyI7czoxMToic3VwZXJfYWRtaW4iO3M6MDoiIjtzOjk6ImxvZ2luX21kNSI7czozMjoiZWRmMGFmMDZlYzE3ZGE4ODEwMTdhMmFkZWNlNmE5ODMiO30%3D"},
		{Name: "user_lang", Value: "zh-tw"},
		// Add more cookies as needed
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
	fmt.Println("Response Body:", string(body))

	//body1 := findBody(string(body))

	body1, err := html.Parse(strings.NewReader(string(body)))

	if body != nil {
		// Print the content of the head element
		printNodeContent(body1)
	}

}

// findHead recursively searches for the head element in the HTML document
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
