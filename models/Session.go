package models

type Session struct {
	SessionID    string `json:"sessionID"`
	Login_branch string `json:"login_branch"`
	Login_user   string `json:"login_user"`
	User_lang    string `json:"user_lang"`
	Domain       string `json:"domain"`
	Username     string `json:"username"`
	HashString   string `json:"hashstring"`
	CapchartURL  string `json:"capchartURL"`
}
