<form action="<?php echo SKIN_URL?>write.php" class="editor_form" method="post">
	
<?php include "form.inc.php";?>
	
<div class="function mt20" style="text-align:center">
	<input type="submit" value="등록" class="btn btn_apply" />
	<input type="hidden" name="site" value="<?php echo $siteKey?>" />
	<input type="hidden" name="menu" value="<?php echo $menuID?>" />
	<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|site|pagetype', 1)."&mode=list"?>" />
	<a href="<?php echo getBackUrl('menu|site|pagetype')?>&mode=list" class="btn btn-default">뒤로</a>
</div>
</form>