<?php
include "../common.php";		
include "define.php";	
include_once COMMON_PATH."lib/common.lib.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(trim($_POST['sf']) != "")
	$backUrl = $_POST['backUrl']."&".$_POST['sf']."=".urlencode($_POST['sv'])."&sfv=".$_POST['sf'];
else
	$backUrl = $_POST['backUrl'];


header('Location: '.$backUrl);
?>