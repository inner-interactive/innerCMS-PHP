<form action="update.php" class="editor_form" method="post"
	enctype="multipart/form-data">
	<?php include BASE_SKIN_PATH."form.inc.php"?>

	<div class="btnbox">
		<a class="btn btn-default"
			href="<?=getBackUrl("menu|pno|category|limit|no|sfv|".$_GET['sfv']."|upw|opt")?>&amp;mode=list"
			title="뒤로">뒤로</a> <input class="btn btn-enter" type="submit"
			title="확인" value="확인" /> <input type="hidden" name="backUrl"
			value="<?=getBackUrl("menu|pno|category|limit|no|sfv|".$_GET['sfv']."|upw|opt")?>&amp;mode=view" />
		<input type="hidden" name="no" value="<?=intval($_GET['no'])?>" /> <input
			type="hidden" name="menu" value="<?=$menuID?>" />
		<?=$SKIN->input_hidden_upw();?>
	</div>
</form>
