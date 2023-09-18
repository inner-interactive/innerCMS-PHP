<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
$DB = new DB();
$DB->install_check();
$MENU = new Menu($DB);
$MENU->isCorrectMenuCheck($menuID);

include "visit_insert.php";

$system['menu']['gnb'] = $MENU->makeGnbMenuHtml(0, 1, 3, 1, "gnb");
$system['menu']['allmenu'] = $MENU->makeAllMenuHtml();
$system['menu']['mobile_menu'] = $MENU->makeMenuHtml(0, 1, 0, 1, 'mtree transit');
$system['menu']['sitemap'] = $MENU->makeGnbMenuHtml(0, 1, 3, 3, "");

// 메뉴 정보 가져오기
$system['data']['menu'] = $MENU->getMenuInfo($menuID);
$system['data']['position'] = $MENU->getPositionArray($menuID);

if ($menuID) {
    
    $system['menu']['lnb'] = $MENU->makeLnbMenuHtml();
    $parentID = $system['data']['menu']['parent_id'];
    
    // 3차, 4차, 5차 메뉴 설정
    $rank = $system['data']['menu']['rank'];
    
    $system['menu']['third'] = $system['menu']['fourth'] = $system['menu']['firth'] = '';
    if ($rank >= 3) {
        $system['menu']['third'] = $MENU->makeMenuHtml($system['data']['position'][count($system['data']['position']) - 3]['parent_id'], 3, 3, 2);
    }
    if ($rank >= 4) {
        $system['menu']['fourth'] = $MENU->makeMenuHtml($system['data']['position'][count($system['data']['position']) - 4]['parent_id'], 4, 4, 2);
    }
    if ($rank >= 5) {
        $system['menu']['firth'] = $MENU->makeMenuHtml($system['data']['position'][count($system['data']['position']) - 5]['parent_id'], 5, 5, 2);
    }
    unset($rank);
}


if(isset($system['data']['menu']['menu_type'])){
    switch ($system['data']['menu']['menu_type']) {
        
        case "skin":
            include BASE_PATH . "/" . SITE_NAME . "/config/skin.php";
            break;
        case "contents":
            break;
        default:
            break;
    }
}

include BASE_PATH . "/" . SITE_NAME . "/config/siteinfo.php";
include BASE_PATH . "/" . SITE_NAME . "/jscss.php";
include BASE_PATH . "/" . SITE_NAME . "/layout/header.php";

if ($menuID) {
    $body_file = BASE_PATH . "/" . SITE_NAME . "/layout/" . trim($system['data']['menu']['bodyfile']);
    if (file_exists($body_file)) {
        include $body_file;
    } else {
        echo "파일이 없습니다.";
    }
} else {
    if (defined('PASSWORD_CHECK')) {
        include BASE_PATH . "/" . SITE_NAME . "/layout/password.php";
    } else {
        include BASE_PATH . "/" . SITE_NAME . "/layout/popup.inc.php";
        include BASE_PATH . "/" . SITE_NAME . "/layout/main_body.php";
    }
}

if (COMPLAIN_USE && $menuID) {
    include BASE_PATH . "/" . SITE_NAME . "/layout/complain.php";
}

include BASE_PATH . "/" . SITE_NAME . "/layout/footer.php";