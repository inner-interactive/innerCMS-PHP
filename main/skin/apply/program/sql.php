<?php
include_once COMMON_PATH."lib/editor.lib.php";
include_once COMMON_PATH."lib/program.class.php";
if(!$isAdmin) $_GET['delflag'] = 0;


$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";
$start_date = isset($_GET['start_date']) && $_GET['start_date'] != "" ? trim($_GET['start_date']) : "";
$end_date = isset($_GET['end_date']) && $_GET['end_date'] != "" ? trim($_GET['end_date']) : "";
$status = isset($_GET['status']) && $_GET['status'] != "" ? trim($_GET['status']) : 0;

$_GET['iscomment'] = 0;
$_GET['site_menuid'] = $menuID;

$where = $DB->whereSql("!delflag|!iscomment|site_menuid|category|%subject|%memo|%uname");

if($start_date != ""){
    $where .= " AND datetime1 <= '".$start_date." 00:00:00' AND datetime2 >= '".$start_date." 00:00:00'";
}

if($end_date != ""){
    $where .= " AND datetime1 <= '".$end_date." 00:00:00' AND datetime2 >= '".$end_date." 00:00:00'";
}

if($status == 1){
    $where .= " AND datetime1 <= '".TIME_YMDHIS."' AND datetime2 >= '".TIME_YMDHIS."'";
}else if($status == 2){
    $where .= " AND datetime1 > '".TIME_YMDHIS."' AND datetime2 > '".TIME_YMDHIS."'";
}else if($status == 3){
    $where .= " AND datetime1 < '".TIME_YMDHIS."' AND datetime2 < '".TIME_YMDHIS."'";
}

$orderby = " ORDER BY isimportant DESC, writetime DESC, replyrank ASC, replyorder ASC, indexcode DESC";
$limit_num = intval($SKIN->listLimitNum);
if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if($limit_from < 0) $limit_from = 0;

$limit = " limit ".$limit_from.", ".$limit_num;


$PROGRAM = new Program();
$system['data']['config'] = $PROGRAM->getConfig($menuID);

if(count($system['data']['config']) == 0) exit('프로그램 설정이 되어있지 않습니다.');

$reservUseCheck =  $PROGRAM->reservUseCheck($system['data']['config']);//신청접수 사용여부

if($mode == "list") {
    
    
    $query = "SELECT * FROM ".$PROGRAM->list_table.$where."  ORDER BY writetime DESC".$limit;
    $dbData = $DB->getDBData($query);
    $system['data']['dbData'] = $dbData;
    
    $query = "SELECT count(*) FROM ".$PROGRAM->list_table.$where;
    $dbData = $DB->getDBData($query);
    $system['data']['dbDataTotal'] = $dbData[0][0];
    
    
    $paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
    extract($paging);
    
}else if($mode == "view" || $mode == 'write'){
    
    
    $query = "SELECT * FROM ".$PROGRAM->list_table." WHERE site_menuid = ".$menuID." AND indexcode = $no";
    $dbData = $DB->getDBData($query);
    $system['data']['dbData'] = $dbData;
    $system['data']['picData'] = $SKIN->getFileData($menuID, $no, 'pic');
    $system['data']['files1Data'] = $SKIN->getFileData($menuID, $no, 'files1');
    $system['data']['files2Data'] = $SKIN->getFileData($menuID, $no, 'files2');
    
    
}else if($mode == "status"){
    
    
    if($userID != ""){
        $where = " WHERE b.uid = '{$userID}'";
        $upw = '';
    } else {
        if(isset($_GET['name']) && $_GET['name'] != "" && isset($_GET['upw']) && $_GET['upw'] != "")
        {
            $name = trim($_GET['name']);
            $upw = base64_decode(trim($_GET['upw']));
            
            $query = "SELECT password('".trim($upw)."')";
            $dbData = $DB->getDBData($query);
            $upw = $dbData[0][0];
            
            $where = " WHERE b.name = '{$name}' AND b.upw = '{$upw}'";
        }else
        {
            $where = " WHERE 0";
            $upw = '';
        }
    }
    
    $where .= " AND a.site_menuid = ".$menuID;
    
    $orderby = " ORDER BY b.writetime DESC";
    
    
    $query = "SELECT count(*) FROM ".$PROGRAM->list_table." AS a RIGHT JOIN ".$PROGRAM->apply_table." AS b ON a.indexcode = b.programcode".$where;
    $dbData = $DB->getDBData($query);
    $_system['html']['dbdataTotal'] = $dbData[0][0];
    
    $query = "SELECT a.*, b.indexcode as no, b.status as apply_status FROM ".$PROGRAM->list_table." AS a RIGHT JOIN ".$PROGRAM->apply_table." AS b ON a.indexcode = b.programcode".$where.$orderby.$limit;		// data
    $dbData = $DB->getDBData($query);
    
    for($i = 0; $i < count($dbData); $i++)
    {
        $query = "SELECT count(*) FROM ".$PROGRAM->apply_table." WHERE programcode = ".$dbData[$i]['indexcode'];
        $cdbData = $DB->getDBData($query);
        $dbData[$i]['current'] = $cdbData[0][0];
    }
    
    $system['html']['dbData'] = $dbData;
    
    
    
    
}

