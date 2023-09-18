<form action="<?php echo SKIN_URL?>write.php" class="editor_form" method="post" enctype="multipart/form-data">
	
	<?php include "form.inc.php";?>
		
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="등록" class="btn btn_apply" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="banner_type" value="<?php echo $type?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|type', 1)?><?=$type != 'tag' ? "&mode=view" : ""?>" />
		<a href="<?php echo getBackUrl('menu|type')?>&mode=list" class="btn btn-default">뒤로</a>
	</div>
</form>

