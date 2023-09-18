<form action="<?php echo SKIN_URL?>update.php" class="editor_form" method="post">
	
	<table class="table_basic">
		<caption>콘텐츠 수정</caption>
		<tbody>
		
			<tr>
				<td class="tleft">
				<?php 
				if(file_exists($contentsfile)){
				$fp = fopen($contentsfile, 'r');
				$text = "";
				while (!feof($fp)) {
					$text .= fread($fp, 1024);
				}
				fclose($fp);
				?>
					<textarea name="" id="" class="wd90 inputs" style="height:600px"><?php echo $text?></textarea>
				<?php }?>
				</td>
			</tr>
			
		</tbody>
	</table>
	
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="site" value="<?php echo trim($_GET['site'])?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|site', 1)."&mode=view"?>" />
		<a href="<?php echo getBackUrl('menu|site|type')?>&mode=view" class="btn btn-default">뒤로</a>
	</div>
</form>