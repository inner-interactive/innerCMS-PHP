<?php
if (! $isAdmin)
    $_GET['delflag'] = 0;
$list_default_num = 5;
$keyword = isset($_GET['keyword']) && trim($_GET['keyword']) != "" ? clean_xss_tags($_GET['keyword']) : "";
$search_type_array = array(
    "all" => "전체",
    "contents" => "페이지",
    "skin" => "게시물"
);
$menuType = isset($_GET['type']) && trim($_GET['type']) != "" ? trim($_GET['type']) : "all";

$search_count = array();
foreach ($search_type_array as $key => $value) {
    $search_count[$key] = 0;
}

$_GET['iscomment'] = 0;

$where = $DB->whereSql("!delflag|!iscomment|%subject|%memo|%uname");
$orderby = " ORDER BY writetime DESC, indexcode DESC";
$limit_num = intval($SKIN->listLimitNum);
if ($limit_num <= 0)
    $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if ($limit_from < 0)
    $limit_from = 0;

$limit = " limit " . $limit_from . ", " . $limit_num;

$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";

$search_where = " AND ( subject like '%" . $keyword . "%' OR memo like '%" . $keyword . "%' OR uname like '%" . $keyword . "%')";
$where .= $search_where;

$column = "indexcode, subject, writetime, memo, iscomment ";

if ($mode == "list") {

    if ($keyword != "") {

        // skin 검색 결과
        $query = "SELECT menu_id, menu_title, db_table FROM " . MENU_TABLE . " WHERE site = '" . SITE_NAME . "' AND menu_type = 'skin' AND db_table != '' AND LEFT(db_table, 5) = 'inner' AND menu_hide1 != 1 AND menu_hide2 != 1 AND menu_hide3 != 1 ORDER BY rank ASC, menu_order ASC";
        $skinMenuData = $DB->getDBData($query);

        $query = $total_query = "";
        $skinInfo = array();

        $c = 0;
        foreach ($skinMenuData as $value) {
            $_tableName = trim($value['db_table']);
            $_menu_id = intval($value['menu_id']);
            $_menu_title = trim($value['menu_title']);

            if ($DB->tableExists($_tableName)) {
                $total_query = "SELECT count(*) FROM " . $_tableName . $where;
                $dbData = $DB->getDBData($total_query);
                $_total = intval($dbData[0][0]);

                if ($_total > 0) {

                    $skinInfo[$c]['menu_id'] = $_menu_id;
                    $skinInfo[$c]['menu_title'] = $_menu_title;

                    $query = "SELECT " . $column . " FROM " . $_tableName . $where . $orderby . $limit;
                    $_dbData = $DB->getDBData($query);

                    $skinInfo[$c]['dbData'] = $_dbData;
                    $skinInfo[$c]['total'] = $_total;

                    $search_count['skin'] += $_total;
                    $c ++;
                }
            }
        }

        //contents 검색결과
        $contentsInfo = array();

        $query = "SELECT menu_id, menu_title, use_file FROM " . MENU_TABLE . " WHERE site = '" . SITE_NAME . "' AND menu_type = 'contents' AND menu_hide1 != 1 AND menu_hide2 != 1 AND menu_hide3 != 1 ORDER BY rank ASC, menu_order ASC";
        $contentsMenuData = $DB->getDBData($query);

        $c = 0;
        foreach ($contentsMenuData as $value) {

            $_menu_id = intval($value['menu_id']);
            $_menu_title = trim($value['menu_title']);
            $_use_file = trim($value['use_file']);
    
            //파일에 저장되는 컨텐츠 메뉴일경우
            if($_use_file){
                $_inc_file = file_get_contents(BASE_PATH . "/" . SITE_NAME . "/inc/" . $_menu_id.".php");
                $_pos = strpos($_inc_file, $keyword);
                if ($_pos !== false) {
                    $contentsInfo[$c]['menu_id'] = $_menu_id;
                    $contentsInfo[$c]['menu_title'] = $_menu_title;
                    $contentsInfo[$c]['text'] = strcut_for_keyword($_inc_file, $keyword);
                    $c ++;
                }
            }else{
                //contents db에 저장되는 메뉴일 경우
                $query = "SELECT contents FROM ".CONTENTS_TABLE." WHERE site = '".SITE_NAME."' AND menu_id = $_menu_id AND isapply = 1 AND contents LIKE '%".$keyword."%'";
                $_contentsData = $DB->getDBData($query);

                if(count($_contentsData)){
                    $contentsInfo[$c]['menu_id'] = $_menu_id;
                    $contentsInfo[$c]['menu_title'] = $_menu_title;
                    $contentsInfo[$c]['text'] = htmlspecialchars_decode($_contentsData[0]['contents']);
                    $c ++;
                }
            }
           
            
           
        }

        $search_count['contents'] = $c;

        $search_count['all'] = $search_count['skin'] + $search_count['contents'];
    } else {

        $contentsInfo = $skinInfo = null;
    }
} else if ($mode == "view") {

    $smenu = isset($_GET['smenu']) ? intval($_GET['smenu']) : 0;

    $query = "SELECT db_table FROM " . MENU_TABLE . " WHERE menu_id = " . $smenu;
    $menuData = $DB->getDBData($query);
    $db_table = $menuData[0]['db_table'];

    $query = "SELECT $column FROM " . $db_table . $where . $orderby . $limit;
    $dbData = $DB->getDBData($query);
    $system['data']['dbData'] = $dbData;

    $query = "SELECT count(*) FROM " . $db_table . $where;
    $dbData = $DB->getDBData($query);
    $system['data']['dbDataTotal'] = $dbData[0][0];

    $paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
    extract($paging);
}

