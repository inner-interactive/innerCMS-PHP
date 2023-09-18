<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once "menuinfo.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');
//필수 입력 체크

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

$blankList = array("menu_title|메뉴명을", "!bodyfile|페이지 바디를");

$second_id = intval($_POST['second_id']);
$menu_type = trim($_POST['menu_type']);
//하위메뉴가 선택되어 있다면 입력하지 않아도 됨.
if($second_id == 0)
{
	if($menu_type == "skin"){
	    array_push($blankList, "!skinUrl|게시판 스킨을");
	}else if($menu_type == "link"){
	    array_push($blankList, "href|메뉴 링크를");
	}
}

blankCheck($blankList);

$_POST['menu_id'] = intval($_POST['no']);
if($_POST['menu_id'] == 0) alert('메뉴값이 넘어오지 않았습니다.');

$DB = new DB();
$menuInfo = new MenuInfo();
$column = $DB->getColumns(MENU_TABLE, array('menu_id', 'route', 'rank', 'menu_order', 'parent_id', 'rank'));


//기본 값 설정
$_POST['menu_hide1'] = isset($_POST['menu_hide1']) && trim($_POST['menu_hide1']) != "" ? trim($_POST['menu_hide1']) : 0;
$_POST['menu_hide2'] = isset($_POST['menu_hide2']) && trim($_POST['menu_hide2']) != "" ? trim($_POST['menu_hide2']) : 0;
$_POST['menu_hide3'] = isset($_POST['menu_hide3']) && trim($_POST['menu_hide3']) != "" ? trim($_POST['menu_hide3']) : 0;
$_POST['target'] = isset($_POST['target']) && trim($_POST['target']) != "" ? trim($_POST['target']) : "S";

$_POST['href'] = $menu_type == "link" ? trim($_POST['href']) : "";



if($menu_type == "skin"){

	if(isset($_POST['skinUrl']) &&$_POST['skinUrl'] != ""){
		$tmp = explode("/", trim($_POST['skinUrl']));
		$_POST['skin_group'] = trim($tmp[0]);
		$_POST['skin'] = trim($tmp[1]);
	}
	
	if($_POST['upload_size'] == "") $_POST['upload_size'] = $menuInfo->default_upload_size;
	if($_POST['upload_unit'] == "") $_POST['upload_unit'] = $menuInfo->default_upload_unit;
	if($_POST['list_limit_num'] == "") $_POST['list_limit_num'] = $menuInfo->default_list_limit_num;
	
	if(isset($_POST['table_make']) && trim($_POST['table_make']) != ""){
	    $_POST['db_table'] = make_table($_POST['table_make'], $_POST['menu_title']);
	}
	
}else{
	$_POST['skin'] =
	$_POST['skin_group'] =
	$_POST['skin_header'] =
	$_POST['skin_tail'] =
	$_POST['upload_ext'] =
	$_POST['upload_unit'] =
	$_POST['categoryList'] =
	$_POST['db_table'] =
	$_POST['db_table2'] =
	"";
	
	$_POST['list_limit_num'] =
	$_POST['subject_limit_num'] =
	$_POST['html_use'] =
	$_POST['upload_size'] =
	$_POST['comment_use'] =
	$_POST['category_use'] = 0;
	
	foreach($menuInfo->grantList as $value){
		$_POST[$value['name']] = 0;
	}
}


if($menu_type == 'contents' && $_POST['contents'] != ""){
    
    
    //파일에 저장시
    if(isset($_POST['use_file']) && $_POST['use_file']){
        
        $inc_file = BASE_PATH."/".trim($_POST['site'])."/inc/".$_POST['menu_id'].".php";
        $inc_text = isset($_POST['contents']) ? stripslashes(trim($_POST['contents'])) : "";
        $inc_text = NO_DIRECT_SOURCE .  $inc_text;
        
        if(!file_exists($inc_file)){
            $fp = fopen($inc_file, 'w');
            chmod($inc_file, 0646);
            fclose($fp);
        }
        
        $fp = fopen($inc_file, 'w');
        fwrite($fp, $inc_text);
    }

	$query = "SELECT count(*) FROM ".CONTENTS_TABLE." WHERE isapply = 1 AND menu_id = ".$_POST['menu_id']." AND contents = '".htmlspecialchars(trim($_POST['contents']), ENT_QUOTES)."'";
	$dbData = $DB->getDBData($query);
	
	//같은 내용이면 적용시키지 않는다.
	if($dbData[0][0] == 0){
    
    	$query = "UPDATE ".CONTENTS_TABLE." SET isapply = 0 WHERE menu_id = ".$_POST['menu_id'];
    	$DB->runQuery($query);
    	
    	$contentColumn = $DB->getColumns(CONTENTS_TABLE, array('content_id'));
    
    	$_POST['menu_id'] = $_POST['menu_id'];
    	$_POST['uid'] = $userID;
    	$_POST['contents'] = isset($_POST['contents']) ? (trim($_POST['contents'])) : "";
    	
    	$_POST['isapply'] = $_POST['use_file'] == 1 ? 0 : 1;   //소스코드 입력 방식일 경우 컨텐츠 히스토리는 저장하되 적용시키지는 않는다.
    	$_POST['writetime'] = TIME_YMDHIS;
    	$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
    	$query = $DB->insertSql($contentColumn, $_POST, CONTENTS_TABLE);
    	$DB->runQuery($query);
	}

}


$query = $DB->updateSql($column, $_POST, MENU_TABLE, "menu_id");
$DB->runQuery($query);

//program class 연동
if($menu_type == 'skin' && $_POST['skin'] == "program"){
    include_once COMMON_PATH."lib/program.class.php";
    $PROGRAM = new Program();
    $PROGRAM->setConfig($_POST['no']);
}


$backUrl = html_entity_decode($_POST['backUrl']);
header('location:'.$backUrl);
exit;


?>