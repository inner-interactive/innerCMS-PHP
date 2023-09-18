<?php
$dbData = $system['data']['dbData'];
?>
<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu")?>&amp;mode=write">등록</a>
</div>
<table class="table_basic th-g">
	<caption>회원권한 리스트</caption>
	<thead>
		<tr>
			<th>그룹명</th>
			<th>권한명</th>
			<th>권한레벨</th>
			<th>수정</th>
			<th>삭제</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i = 0; $i < count($dbData); $i++){
		$_viewLink = getBackUrl("menu")."&amp;mode=view&amp;no=".$dbData[$i]['indexcode'];
	?>
	<tr>
		<td><?=$dbData[$i]['groupname']?></td>
		<td><?=$dbData[$i]['name']?></td>
		<td><?=$dbData[$i]['authlevel']?></td>
		<td><a href="<?=getBackUrl("menu")."&amp;mode=update&amp;no=".$dbData[$i]['indexcode']?>" class="in_btn btn_modify">수정</a></td>
		<td><a href="<?=SKIN_URL?>delete.php?no=<?=$dbData[$i]['indexcode']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|pno|category|limit|opt", 1))?>" class="in_btn btn_delete delete">삭제</a></td>
	</tr>
	<?php }?>
	</tbody>
</table>
<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu")?>&amp;mode=write">등록</a>
</div>