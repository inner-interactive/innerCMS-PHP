<?php 
include "common.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

$DB = new DB();
$DB->install();
$query = "SHOW TABLES";
$tableData = $DB->getDBData($query);

foreach($tableData as $value){
	echo "<p>".$value[0]." 테이블이 생성되었습니다.</p>";
}

//menuinfo 관련 데이터 등록은 common/conf/install.php 파일에서 따로 등록
include COMMON_PATH."conf/install.php";

$query = "SELECT count(*) FROM `menuinfo`";
$menuData = $DB->getDBData($query);

echo "<p>".intval($menuData[0][0])." 개의 메뉴가 생성되었습니다.</p>";

echo "<a href=\"./\">메인페이지로 이동</a>";
?>