<?php
include_once "menuinfo.class.php";
include_once COMMON_PATH."lib/editor.lib.php";

$menuInfo = new MenuInfo();
$siteKeyList = $menuInfo->siteKeyList;
$siteList = $menuInfo->siteList;
$menuTypeList = $menuInfo->menuType;


$siteKey = isset($_GET['site']) && $_GET['site'] != "" ? trim($_GET['site']) : 'main'; 

if(!in_array($siteKey, $siteKeyList)) $siteKey = $siteKeyList[0];
$bodyFileList = $menuInfo->getBodyFileList($siteKey);
$IncFileList = $menuInfo->getIncFileList($siteKey);
$DBTableList = $menuInfo->getDBTableList();




if($mode == "write"){
    $caption = "등록";
    $system['data']['dbData'] = null;
    $contents = null;
    $system['data']['contentsHistoryData'] = null;
}

if($mode == "update"){
    
    $no = isset($_GET['no']) ? intval($_GET['no']) : 0;
    if($no == 0) alert('잘못된 접근입니다.');
    
    
    $caption = "수정";
    $system['data']['dbData'] = $menuInfo->getMenuInfo($no, $siteKey);
    
    
    if($system['data']['dbData']['use_file'] == 1){
        $contents = "";
        $inc_file = BASE_PATH."/".$system['data']['dbData']['site']."/inc/".$no.".php";
        
        if(file_exists($inc_file)){
            $fp = fopen($inc_file,"r");
            while (!feof($fp)) {
                $contents .= fread($fp,1024);
            }
            fclose($fp);
        }
        $contents = htmlspecialchars_decode(str_replace(NO_DIRECT_SOURCE, "", $contents), ENT_QUOTES);
        
    }else{
        $query = "SELECT contents FROM ".CONTENTS_TABLE." WHERE menu_id = ".$no." AND isapply = 1";
        $dbData = $DB->getDBData($query);
        $contents = isset($dbData[0]) ? $dbData[0]['contents'] : "";
        
    }
    
    $query = "SELECT * FROM ".CONTENTS_TABLE." WHERE menu_id = ".$no." ORDER BY writetime DESC";
    $dbData = $DB->getDBData($query);
    $system['data']['contentsHistoryData'] = $dbData;
}

