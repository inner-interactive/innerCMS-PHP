<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";

if (count($_POST) == 0){
    alert('잘못된 접근입니다.');
}
$DB = new DB();

$json = array();
$isError = false;
$msg = "";

$data['site'] = SITE_NAME;
$data['menu_id'] = intval($_POST['menu_id']);
$data['uid'] = $userID;
$data['uname'] = $userName;
$data['complain'] = trim($_POST['complain']);
$data['point'] = intval($_POST['point']);
$data['ip'] = $_SERVER['REMOTE_ADDR'];

//비로그인 사용자가 등록할 수 있도록 수정
if ($data['menu_id'] > 0) {
    if ($data['point'] > 0 && $data['point'] < 6) {
        
        // 중복 게시글 등록 방지
        $minute = 10; // 10분
        $ten_minutes_ago = date("Y-m-d H:i:s", time() - 60 * $minute);
        $query = "SELECT count(*) FROM " . COMPLAIN_TABLE . " WHERE ip = '" . $data['ip'] . "' AND menu_id = " . $data['menu_id'] . " AND writetime >= '" . $ten_minutes_ago . "'";
        $dbData = $DB->getDBData($query);
        
        if ($dbData[0][0] > 0) {
            $isError = true;
            $msg = $minute . '분 이내에 의견을 연속으로 등록할 수 없습니다.';
        } else {
            
            $column = $DB->getColumns(COMPLAIN_TABLE, array(
                'indexcode'
            ));
            $column['writetime']['type'] = "now";
            $query = $DB->insertSql($column, $data, COMPLAIN_TABLE);
            $DB->runQuery($query);
            $msg = '의견이 등록되었습니다.';
        }
    } else {
        $isError = true;
        $msg = '이 페이지에 대한 만족도를 선택해 주세요';
    }
} else {
    $isError = true;
    $msg = '메뉴정보가 없습니다.';
}

$json['error'] = $isError;
$json['msg'] = $msg;
echo json_encode($json);

?>
