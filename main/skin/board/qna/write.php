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

$_POST['f1'] = $statusList[0];
?>