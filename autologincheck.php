<?php 
$cookie = md5('cs_userid');
$cookie_userid = array_key_exists($cookie, $_COOKIE) ? base64_decode($_COOKIE[$cookie]) : "";


if($cookie_userid){
    
    include_once COMMON_PATH."lib/db.class.php";
    
    if(!isset($DB)){
        $DB = new DB();
    }
    
    $cookie_userid = substr(preg_replace("/[^a-zA-Z0-9_]*/", "", $cookie_userid), 0, 20);
    
    $query = "select * from ".MEMBER_TABLE." where userid = '{$cookie_userid}'";
    $userData = $DB->getDBData($query);
    
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $userData[0]['userpw']);
    
    $cookie = md5('cs_auto');
    $cookie_auto = array_key_exists($cookie, $_COOKIE) ? base64_decode($_COOKIE[$cookie]) : "";
    
    if($cookie_auto == $key && $cookie_auto){
        
        $_SESSION['user_id'] = $userData[0]['userid'];						// userid
        $_SESSION['user_level'] = $userData[0]['authlevel'];				// authlevel
        $_SESSION['user_realname'] = $userData[0]['realname'];		// realname
        $_SESSION['user_uname'] = $userData[0]['nickname'];			// nickname
        $_SESSION['user_opt'] = $userData[0]['opt'];							// opt : category number => member type
        $_SESSION['user_catetory'] = $userData[0]['category'];			// catetory
    }
  
}
?>