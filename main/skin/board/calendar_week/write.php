<?php
// 스킨 별 필수입력 값 설정이나 post 값 세팅이 필요한 경우 여기에 작성한다.
$blankList = array(
    "subject|제목을",
    "memo|내용을"
);
if ($userID == "") {
    array_push($blankList, "uname|이름을");
    array_push($blankList, "upw|비밀번호를");
}
blankCheck($blankList);

term_check($_POST['date1'], $_POST['date2']);
$_POST['f1'] = isset($_POST['f1']) && count($_POST['f1']) > 0 ? implode("|", $_POST['f1']) : "";
if (isset($_POST['f2']) && count($_POST['f2']) > 0) {
    $_POST['f2'] = array_unique($_POST['f2']);
    foreach ($_POST['f2'] as $key => $value) {
        if ($value == "")
            unset($_POST['f2'][$key]);
    }
    $_POST['f2'] = implode("|", $_POST['f2']);
} else
    $_POST['f2'] = "";

?>