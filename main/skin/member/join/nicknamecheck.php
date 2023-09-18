<?php
if (count($_POST) != 0) {

    include "../../../../common.php"; // root define
    include "../../../define.php"; // sub define
    include_once COMMON_PATH . "lib/common.lib.php";
    include_once COMMON_PATH . "lib/db.class.php";

    $nickname = trim($_POST['nickname']);

    if ($nickname != "") {

        $DB = new DB();
        $query = "SELECT count(*) FROM " . MEMBER_TABLE . " WHERE nickname = '" . $nickname . "'"; // total
        $dbData = $DB->getDBData($query);
        $_CountNum = intval($dbData[0][0]);

        if ($_CountNum <= 0) {
            echo "사용이 가능한 닉네임 입니다.";
        } else {
            echo "이미 사용중인 닉네임 입니다. 다른 닉네임을 사용해주세요";
        }
    } else {
        echo "닉네임을 입력해주세요";
    }
}

?>