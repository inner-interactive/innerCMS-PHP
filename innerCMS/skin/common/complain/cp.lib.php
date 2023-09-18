<?php 

function getSiteName($siteKey = '')
{
	global $_system;
	$siteData = sread($_system,  $_system['path']['root']."/".$siteKey."/conf/site.data");
	$siteName = trim($siteData['author']);
	return $siteName;
}

function getSmenuFullData($siteKey = '')
{
	global $_system;
	
	$_smenuDataFromFile = sread($_system, $_system['path']['root']."/".$siteKey."/conf/smenu.data");
	$_smenuDataStr= $_smenuDataFromFile['smenustr'];
	$_smenuDataStrDiv = explode($_system['data']['char']['char3'][0], $_smenuDataStr);
	
	for($i = 0; $i < count($_smenuDataStrDiv); $i++){
		$_smenuRankDivData = sanalysis($_system, $_smenuDataStrDiv[$i]);
		$_href =$_smenuRankDivData['href'];
		$_type = $_smenuRankDivData['type'];
	
		if($_href != ""){
			$_smenuFData[$_href] = $_smenuRankDivData;
		}
	}
	
	return $_smenuFData;
}

function getMenuName($siteKey = '', $smenu = '')
{
	global $menuData;
	if($siteKey == '' || $smenu == '') return null;
	
	$_smenuFData = $menuData;
	$name = "";

	$_sMenu_tmp = $_smenuFData[$smenu];
	$i = 0;
	while($_sMenu_tmp != null){
		$_position[$i++] = $_sMenu_tmp;
		$_parent_tmp = $_sMenu_tmp['parent'];
		$_sMenu_tmp = $_smenuFData[$_parent_tmp];
	}
	
	$_reverse_position = array();
	for($i=0; $i<count($_position); $i++){
		$_reverse_position[count($_position)-$i-1] = $_position[$i];
	}
	
	for($i = 0; $i < count($_reverse_position); $i++)
	{
		if($i == 0) $name .= $_reverse_position[$i]['title'];
		else $name .= "&nbsp;>&nbsp;".$_reverse_position[$i]['title'];
	}
	
	return $name;
	
}

function getMenuListForMenuOrder($siteKey = ''){
	global $dbInfo, $_system, $TABLE , $_skin;
		
	$menuData = getSmenuFullData($siteKey);
	$_today = date("Y-m-d");
	
	$html = "";
	foreach($menuData as $_smenu => $value)
	{
		
		//전체 의견수 구하기
		$query = "SELECT count(*) FROM ".$TABLE['complain']." WHERE site = '".$siteKey."' AND sMenu = '$_smenu'";
		$_data = getDBData($dbInfo, $query);
		$total_complain = intval($_data[0][0]);
		
		
		//오늘 의견수 구하기
		$query = "SELECT count(*) FROM ".$TABLE['complain']." WHERE site = '".$siteKey."' AND sMenu = '$_smenu' AND writetime >= '".$_today." 00:00:00' AND writetime <= '".$_today." 23:59:59'";
		$_data= getDBData($dbInfo, $query);
		$today_complain = $_data[0][0];
		
		$html .= "<tr class=\"depth{$value['rank']}\">".PHP_EOL;
		$html .=  "<td>".$total_complain."</td>".PHP_EOL;
		$html .=  "<td>".$today_complain."</td>".PHP_EOL;
		$html .=  "<td>".$_smenu."</td>".PHP_EOL;
		$html .=  "<td class=\"tleft menu_title\">";
		if($dbData[$i]['rank'] != 1) $html .=  "<img src=\"{$_skin}img/icon_catlevel.gif\" />&nbsp;";
		$html .=  "<a href=\"".sbackIncurl("sMenu|site|order")."&mode=list&site={$siteKey}&menu_id={$_smenu}\">".$value['title']."</a>";
		$html .=  "</td>".PHP_EOL;
		$html .=  "</tr>".PHP_EOL;
		
	}
	
	return $html;
	
}


function getMenuListForTotalOrder($siteKey = ''){
	global $dbInfo, $_system, $TABLE , $_skin;

	$menuData = getSmenuFullData($siteKey);
	
	$_today = date("Y-m-d",time());
	
	
	$data = array();
	foreach($menuData as $_smenu => $value)
	{
		//전체 의견수 구하기
		$query = "SELECT count(*) FROM ".$TABLE['complain']." WHERE site = '{$siteKey}' AND sMenu = '".$_smenu."'";
		$_data= getDBData($dbInfo, $query);
		$total_complain = intval($_data[0][0]);
		
		$data[$_smenu] = $total_complain;
		
	}
	
	arsort($data);
	
	$html = "";
	foreach($data as $key => $total_complain)
	{
		$value = $menuData[$key];
		
		//오늘 의견수 구하기
		$query = "SELECT count(*) FROM ".$TABLE['complain']." WHERE site = '{$siteKey}' AND sMenu = '".$key."' AND writetime >= '".$_today." 00:00:00' AND writetime <= '".$_today." 23:59:59'";
		$_data= getDBData($dbInfo, $query);
		$today_complain = $_data[0][0];
		
		$html .= "<tr class=\"depth{$value['rank']}\">".PHP_EOL;
		$html .=  "<td>".$total_complain."</td>".PHP_EOL;
		$html .=  "<td>".$today_complain."</td>".PHP_EOL;
		$html .=  "<td>".$key."</td>".PHP_EOL;
		$html .=  "<td class=\"tleft\">";
		$html .=  "<a href=\"".sbackIncurl("sMenu|site|order")."&mode=list&site={$siteKey}&menu_id={$key}\">".getMenuName($siteKey, $key)."</a>";
		$html .=  "</td>".PHP_EOL;
		$html .=  "</tr>".PHP_EOL;
	}
	
	
	return $html;
	
}


function getMenuListForRecentOrder($siteKey = ''){
	global $dbInfo, $_system, $TABLE , $_skin;

	$menuData = getSmenuFullData($siteKey);
	
	$_today = date("Y-m-d",time());
	
	
	$data = array();
	foreach($menuData as $_smenu => $value)
	{
		//오늘 의견수 구하기
		$query = "SELECT count(*) FROM ".$TABLE['complain']." WHERE site = '{$siteKey}' AND sMenu = '".$_smenu."' AND writetime >= '".$_today." 00:00:00' AND writetime <= '".$_today." 23:59:59'";
		$_data= getDBData($dbInfo, $query);
		$today_complain = $_data[0][0];
		$data[$_smenu] = $today_complain;
	}
	arsort($data);
	
	$html = "";
	foreach($data as $key => $today_complain)
	{
		$value = $menuData[$key];
		
		//전체 의견수 구하기
		$query = "SELECT count(*) FROM ".$TABLE['complain']." WHERE site = '{$siteKey}' AND sMenu = '".$key."'";
		$_data= getDBData($dbInfo, $query);
		$total_complain = intval($_data[0][0]);
		
		$html .= "<tr class=\"depth{$value['rank']}\">".PHP_EOL;
		$html .=  "<td>".$total_complain."</td>".PHP_EOL;
		$html .=  "<td>".$today_complain."</td>".PHP_EOL;
		$html .=  "<td>".$key."</td>".PHP_EOL;
		$html .=  "<td class=\"tleft\">";
		$html .=  "<a href=\"".sbackIncurl("sMenu|site|order")."&mode=list&site={$siteKey}&menu_id={$key}\">".getMenuName($siteKey, $key)."</a>";
		$html .=  "</td>".PHP_EOL;
		$html .=  "</tr>".PHP_EOL;
	}
	
	
	return $html;
	
}


?>