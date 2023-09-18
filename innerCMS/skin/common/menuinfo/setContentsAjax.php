<?php
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

$no = isset($_GET['no']) ? intval($_GET['no']) : 0;

if(!$no) exit;

$DB = new DB();
$query = "SELECT * FROM ".CONTENTS_TABLE." WHERE content_id = ".$no;
$contentsData = $DB->getDBData($query);

if(!isset($contentsData[0])) exit;

$contents = isset($contentsData[0]) ? htmlspecialchars_decode($contentsData[0]['contents'], ENT_QUOTES) : "";

echo $contents;
?>
