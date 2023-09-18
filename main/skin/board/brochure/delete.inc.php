<form action="delete.php" method="post" enctype="multipart/form-data">
	<div class="askbox">
		<p>게시물을 <?=$buttonText?>하시겠습니까?</p>
		<div>
			<span> <a
				href="<?=getBackUrl("menu|pno|category|limit|no|sfv|".$_GET['sfv']."|upw|opt")?>&amp;mode=view"
				title="취소" class="btn btn-default">취소</a>
			</span> <span><input type="submit" title="<?=$buttonText?>"
				value="<?=$buttonText?>" class="btn btn-enter" /></span>
		</div>
	</div>
	<input type="hidden" name="backUrl"
		value="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv'])?>" />
	<input type="hidden" name="no" value="<?=intval($_GET['no'])?>" /> <input
		type="hidden" name="opt" value="<?=$opt?>" /> <input type="hidden"
		name="menu" value="<?=$menuID?>" />
	<?=$SKIN->input_hidden_upw();?>
</form>
