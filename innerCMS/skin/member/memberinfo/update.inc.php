<form name="user_form" action="<?php echo SKIN_URL?>update.php" class="editor_form" method="post">
	
	<?php include BASE_SKIN_PATH."memberform.inc.php";?>
	
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_modify" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="no" value="<?php echo intval($_GET['no'])?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|no', 1)."&mode=view"?>" />
		<a href="<?php echo getBackUrl('menu|no')?>&mode=view" class="btn btn-default">뒤로</a>
	</div>
</form>