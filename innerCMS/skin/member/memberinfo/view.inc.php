<?php
$dbData = $system['data']['dbData'];
?>

<div class="function mb10">
	<a class="btn btn_modify" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=update">수정</a> 
	<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
</div>

<?php include BASE_SKIN_PATH."memberinfo.inc.php"?>

<div class="function mt30">
	<a class="btn btn_modify" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=update">수정</a> 
	<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
</div>