<form action="<?php echo SKIN_URL?>update.php" class="editor_form" method="post">
	
	<?php
	$siteInfo = isset($_GET['site']) ? $system['siteList'][$_GET['site']] : null;
	?>
	<table class="table_basic">
		<caption>사이트 정보 보기</caption>
		<tbody>
			<?php foreach($siteInfoTitle as $key => $value){?>
			<tr>
				<th><label for="<?=$key?>"><?=isset($siteInfoTitle[$key]) ? $siteInfoTitle[$key] : $key?></label></th>
				<td class="tleft"><input type="text" id="<?=$key?>" name="<?=$key?>" value="<?php echo isset($siteInfo[$key]) ? $siteInfo[$key] : ""?>" <?php if($key == 'maincss' || $key == 'subcss'){?>placeholder="<?=$_GET['site']?>폴더를 기준으로 상대경로로 입력해주세요 ex) jscss/main.css" <?php }?> class="inputs wd50" /></td>
			</tr>
			<?php }?>
			
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