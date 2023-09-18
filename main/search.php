<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";

if (count($_REQUEST) == 0) alert('잘못된 접근입니다.');

$keyword = clean_xss_tags($_REQUEST['keyword']);

if ($keyword != "") {
    
    $DB = new DB();
    $query = "SELECT menu_id FROM " . MENU_TABLE . " WHERE site = '" . SITE_NAME . "' AND route = 'search'";
    $dbData = $DB->getDBData($query);
    $menu_id = intval($dbData[0]['menu_id']);
    
    
    //검색 히스토리 저장
    $query = "SELECT count(*) AS cnt FROM ".SEARCH_HISTORY_TABLE." WHERE keyword = '{$keyword}'";
    $dbData = $DB->getDBData($query);
    
    $row_count = intval($dbData[0]['cnt']);
    if($row_count > 0){
        
        $query = "UPDATE ".SEARCH_HISTORY_TABLE." SET count = count + 1, ip = '".$_SERVER['REMOTE_ADDR']."', writetime = now() WHERE keyword = '{$keyword}'";
    }else{
        $query = "INSERT INTO ".SEARCH_HISTORY_TABLE." SET keyword = '{$keyword}', count = 1, ip = '".$_SERVER['REMOTE_ADDR']."', writetime = now()";
    }
    $DB->runQuery($query);
    
    header("location:./?menu=" . $menu_id . "&keyword=" . urlencode($keyword));
} else {
    alert('검색어를 입력하세요');
}
?>