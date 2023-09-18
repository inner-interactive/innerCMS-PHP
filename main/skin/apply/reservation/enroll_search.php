<?php
include "../../../../common.php";		
include "../../../define.php";	
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if($_POST['name'] == "") alert('성명을 입력하세요');
if($_POST['upw'] == "") alert('비밀번호를 입력하세요');
	
$name = urlencode(trim($_POST['name']));
$upw = base64_encode(trim($_POST['upw']));

$backUrl = html_entity_decode(($_POST['backUrl']));
$backUrl .= "&name=".$name."&upw=".$upw;

header('Location: '.$backUrl);
?>