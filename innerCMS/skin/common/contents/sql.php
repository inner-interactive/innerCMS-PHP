<?php
$siteList = getSiteList();
foreach($siteList as $key => $value){
	$defaultSite = $key;
	break;
}
$site = isset($_GET['site']) ? trim($_GET['site']) : $defaultSite;
$type = isset($_GET['type']) ? trim($_GET['type']) : $contentsType[0];



if($mode == "view"){
	
	$dirContents = array();
	$extArr = array();
	$dir = "";
	switch ($type){
		case "Layout" :
			$dir = BASE_PATH."/".$site."/layout/";
			$extArr = array('php');
			break;
		case "CSS" :
			$dir = BASE_PATH."/".$site."/jscss/";
			$extArr = array('css');
			break;
			
		case "JavaScript" :
			$dir = BASE_PATH."/".$site."/jscss/";
			$extArr = array('js');
			break;
		case "Skin" :
			$dir = BASE_PATH."/".$site."/skin/";
			$extArr = array('php', 'js', 'css');
			break;
	}
	
	if(is_dir($dir)){
		$dirContents = getDirContents($dir);
	}
	
	
	$_dirContents = array();
	foreach($dirContents as $value){
		$ext = pathinfo($value, PATHINFO_EXTENSION);
		if(in_array($ext, $extArr)){
			array_push($_dirContents, $value);
		}
	}
	$dirContents = $_dirContents;
	
}else if($mode == "update"){
	$contentsfile = isset($_GET['file']) ? BASE_PATH."/".urldecode($_GET['file']) : "";
}