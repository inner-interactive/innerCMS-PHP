<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

$blank_array = array(
    "userid|아이디를",
    "userpw|비밀번호를"
);
blankCheck($blank_array);

$backUrl = trim($_POST['backUrl']);

$DB = new DB();
$where = $DB->whereSql("userid");
$query = "SELECT * FROM " . MEMBER_TABLE . $where;
$userData = $DB->getDBData($query);

if (count($userData) > 0) {

    $upw = trim($_POST['userpw']);
    $db_upw = $userData[0]['userpw'];
    $query = "SELECT password('{$upw}')";
    $_data = $DB->getDBData($query);
    $_upw = $_data[0][0];

    if ($_upw == $db_upw) {

        $db_isblocked = $userData[0]['isblocked'];

        if ($db_isblocked == 0) {
            $_SESSION['user_id'] = $userData[0]['userid']; // userid
            $_SESSION['user_level'] = $userData[0]['authlevel']; // authlevel
            $_SESSION['user_realname'] = $userData[0]['realname']; // realname
            $_SESSION['user_uname'] = $userData[0]['nickname']; // uname

            $query = "UPDATE " . MEMBER_TABLE . " SET lognum = lognum + 1, lastlogintime = now()  WHERE userid='" . $_SESSION['user_id'] . "'";
            $DB->runQuery($query);
            
            $query = "INSERT INTO ".LOGIN_HISTORY_TABLE."(`userid`, `logintime`, `ip`) VALUES ('".$_SESSION['user_id']."', now(), '".$_SERVER['REMOTE_ADDR']."')";
            $DB->runQuery($query);

            header('location:' . $backUrl);
        } else {
            alert('로그인이 제한 되었습니다. 관리자에게 문의 하십시오.');
        }
    } else {
        alert('비밀번호가 잘못되었습니다.');
    }
} else {
    alert('등록되지 않은 사용자입니다.');
}

?>