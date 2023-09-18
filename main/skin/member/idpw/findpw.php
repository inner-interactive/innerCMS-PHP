<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/skin.class.php";
include_once COMMON_PATH . "lib/grant.class.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

    
// 필수 입력 체크
$blankList = array(
    "userid|아이디를",
    "name|이름을",
    "email|이메일 주소를"
);
blankCheck($blankList);

$DB = new DB();

$tableName = MEMBER_TABLE;
$userid = isset($_POST['userid']) ? trim($_POST['userid']) : "";
$name = isset($_POST['name']) ? trim($_POST['name']) : "";
$email = isset($_POST['email']) ? trim($_POST['email']) : "";

$where = " WHERE userid = '".$userid."' AND realname = '" . $name . "' AND email = '" . $email . "'";
$query = "SELECT * FROM " . $tableName . $where . " limit 1";
$dbData = $DB->getDBData($query);

if (count($dbData) == 0) {
    $resultlMsg = "조건과 일치하는 아이디가 없습니다.";
} else {
    
    
    /*************************************************
        새로운 암호를 생성함
     *************************************************/
    $new_pw = substr(md5(date('r', time())), 0,8);
    
    /*************************************************
         새로운 암호를 디비에 저장함
     *************************************************/
    $query = "UPDATE ".MEMBER_TABLE." SET userpw = password('".$new_pw."') WHERE userid = '".$userid."'";
    $DB->runQuery($query);
    
    /*************************************************
         새로운 암호를 메일로 발송함
     *************************************************/
    /*************************************************
        관리자  메일로 발송함. 단 메일주소가 있을 경우에
     *************************************************/
    
    if($email !=""){
        
        include COMMON_PATH."lib/sendmail.php";		// 메일 전송을 위한 함수 호출
        include BASE_PATH . "/" . SITE_NAME . "/config/siteinfo.php";
        
        $message = "".
            "<div class=\"formbg1\" style='position:relative;float:left; width:621px;  margin:4px 0 0 0 ;clear:both'>".
            "<div class=\"formbg2\" style='position:relative;float:left;width:621px; '>".
            "<fieldset>".
            "<legend style='overflow:hidden;visibility:hidden;font-size:0;width:0;height:0;margin:0;padding:0;position:absolute;'>등록양식</legend>".
            "<p class=\"formlist\" style='position:relative;float:right;width:600px;margin:20px 0'>".
            "임시 비밀번호는 <font color='red'>".$new_pw. "</font> 입니다. <br>\n".
            "<br>\n".
            "로그인 후에 반드시 비밀번호를 바꾸어 주세요.<br>\n";
        "</p>".
        
        "</fieldset>".
        "</div>".
        "</div>";
        "<br/>\n";
        
        
        if(isset($_system['site']['email']) && trim($_system['site']['email']) != ""){
            $fromemail = trim($_system['site']['email']);
        }else{
            $fromemail = '';
        }
        
        if($fromemail == ""){
            $fromemail = "cs@inner515.co.kr";
        }
        
            
        $author = trim($system['site']['author']);
        if($author == ""){
            $author = "admin";
        }
                
        $subject = "[".$author."] 임시 비밀번호를 알려드립니다.";
        $mail_result = send_htmlmail($fromemail, $author, $email, $name, $subject, $message);
                
        if($mail_result){
            
            $resultlMsg = "임시 비밀번호가 ".$email." 로 발송되었습니다. 임시 비밀번호로 로그인 후에 패스워드를 변경 해 주십시오.";
        }else{
            $resultlMsg = "패스워드가 임시 비밀번호로 수정되었으나 메일 발송이 실패하였습니다. 다시 시도해 주십시오.";
        }
                        
    }else{
        $resultlMsg = "임시 비밀번호가 ".$email." 로 발송되었습니다. 임시 비밀번호로 로그인 후에 패스워드를 변경 해 주십시오.";
        
    }
    
}

$backUrl = urldecode($_POST['backUrl']);
alert($resultlMsg, $backUrl);
exit();

?>