<?php
if (count($_POST) != 0) {

    include "../../../../common.php"; // root define
    include "../../../define.php"; // sub define
    include_once COMMON_PATH . "lib/common.lib.php";
    include_once COMMON_PATH . "lib/db.class.php";

    $id = trim($_POST['id']);

    if ($id != "") {

        $DB = new DB();
        $query = "SELECT count(*) FROM " . MEMBER_TABLE . " WHERE userid = '" . $id . "'"; // total
        $dbData = $DB->getDBData($query);
        $_idCountNum = intval($dbData[0][0]);

        if ($_idCountNum <= 0) {
            echo "사용이 가능한 아이디 입니다.";
        } else {
            echo "이미 사용중인 아이디 입니다. 다른 아이디를 사용해주세요";
        }
    } else {
        echo "아이디를 입력해주세요";
    }
}

?>