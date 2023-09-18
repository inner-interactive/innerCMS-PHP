<?php 
include "../common.php";
include "define.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";


$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
$DB = new DB();
$DB->install_check();
$MENU = new Menu($DB);
$MENU->isCorrectMenuCheck($menuID);

$login_menuID = getLoginMenuID();

//메뉴 정보 가져오기
$system['data']['menu'] = $MENU->getMenuInfo($menuID);
$system['data']['position'] = $MENU->getPositionArray($menuID);

if(!$isAdmin && $system['data']['menu']['route'] != "login"){
	alert('로그인이 필요합니다.', "./route.php?action=login&backUrl=".urlencode(getBackUrl(BACKURL_VALUE, 1)));
	exit;
}


//메뉴 html 생성
$system['menu']['gnb'] = $MENU->makeMenuHtml(0, 1, 1, 1, "gnb");
$system['menu']['allmenu'] = $MENU->makeAllMenuHtml(SITE_NAME);
$system['menu']['mobile_menu'] = $MENU->makeMenuHtml(0, 1, 0, 1, 'mtree transit');


//서브메뉴 lnb, position 생성
if($menuID){
	$system['data']['position'] = $MENU->getPositionArray($menuID);
	$root_menuID = $system['data']['position'][count($system['data']['position']) - 1]['menu_id'];
	$system['menu']['lnb'] = $MENU->makeMenuHtml($root_menuID, 2, 3, 2, "sidebar");
	$system['menu']['position'] = $MENU->makePositionHtml($system['data']['position']);
}

$system['siteList'] = getSiteList();
if(isset($system['data']['menu']['menu_type'])){
    switch ($system['data']['menu']['menu_type']){
        case "skin" :
            include BASE_PATH."/".SITE_NAME."/config/skin.php";
            break;
        case "contents" :
            break;
        default :
            break;
    }
}


include BASE_PATH."/".SITE_NAME."/config/siteinfo.php";
include BASE_PATH."/".SITE_NAME."/jscss.php";
include BASE_PATH."/".SITE_NAME."/layout/header.php";



if($menuID)
{
	$body_file = BASE_PATH."/".SITE_NAME."/layout/".trim($system['data']['menu']['bodyfile']);
	if(file_exists($body_file)){
	    include $body_file;
	}else {
	    echo "파일이 없습니다.";
	}
    
    
}else {
	include BASE_PATH."/".SITE_NAME."/layout/main_body.php";
}


include BASE_PATH."/".SITE_NAME."/layout/footer.php";