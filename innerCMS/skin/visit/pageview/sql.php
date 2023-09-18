<?php
include_once "pageview.class.php";
$PAGEVIEW = new PageView();
$_main_list = array(0 => array('menu_id' => 0, 'menu_title' => '메인', 'rank' => 0));
$menuList = array_merge($_main_list, $PAGEVIEW->menuList);

$total = $PAGEVIEW->getTotal();

for($i = 0; $i < count($menuList); $i++){
	$_menu_id = intval($menuList[$i]['menu_id']);
	$_count = $PAGEVIEW->getCount($_menu_id);
	$menuList[$i]['count'] = $_count;
	$menuList[$i]['percent'] = $_count > 0 ? round($_count / $total * 100, 2) : 0;
}

