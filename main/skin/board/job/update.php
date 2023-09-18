<?php
// 스킨 별 필수입력 값 설정이나 post 값 세팅이 필요한 경우 여기에 작성한다.
$blankList = array(
    "subject|제목을",
    "memo|내용을"
);
blankCheck($blankList);

if ($userID == "" && ! chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}

term_check($_POST['date1'], $_POST['date2']);

?>