<?php
$siteInfo = isset($_GET['site']) ? $system['siteList'][$_GET['site']] : null;
?>
<table class="table_basic">
	<caption>사이트 정보 보기</caption>
	<tbody>
		<?php foreach($siteInfoTitle as $key => $value){?>
		<tr>
			<th><?=isset($siteInfoTitle[$key]) ? $siteInfoTitle[$key] : $key?></th>
			<td class="tleft"><?php echo isset($siteInfo[$key]) ? $siteInfo[$key] : ""?></td>
		</tr>
		<?php }?>
		
	</tbody>
</table>

<div class="function mt30">
	<a class="btn btn_modify" href="<?=getBackUrl("menu|site")?>&mode=update">수정</a>
	<a class="btn btn-default" href="<?=getBackUrl("menu")?>">목록</a>
</div>