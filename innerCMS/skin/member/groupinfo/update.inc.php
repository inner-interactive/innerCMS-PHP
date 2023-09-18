<form action="<?php echo SKIN_URL?>update.php" class="editor_form" method="post">
	
	<?php include "form.inc.php";?>
	
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="수정" class="btn btn_modify" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="no" value="<?php echo intval($_GET['no'])?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|no', 1)?>" />
		<a href="<?php echo getBackUrl('menu|no')?>" class="btn btn-default">뒤로</a>
	</div>
</form>