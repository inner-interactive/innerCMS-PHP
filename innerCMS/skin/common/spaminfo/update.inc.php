<form action="<?php echo SKIN_URL?>update.php" class="editor_form" method="post">
	
	<table class="table_basic">
		<caption>스팸 필터 리스트</caption>
		<tbody>
			<tr>
				<td class="tleft">
					<label for="spam"></label>
					<textarea name="spam" id="spam"  style="height:80px" class="inputs wd90"><?=SPAM_WORD?></textarea>
				</td>
			</tr>
			
		</tbody>
	</table>
	
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="site" value="<?php echo trim($_GET['site'])?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|site', 1)."&mode=view"?>" />
		<a href="<?php echo getBackUrl('menu|site')?>&mode=view" class="btn btn-default">뒤로</a>
	</div>
</form>