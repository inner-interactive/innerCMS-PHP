<?php 
$complainData = $system['html']['complainData'];
?>
<div class="function mt20">
	<a href="<?php echo getBackUrl('menu|limit|site|order')?>" class="btn btn-default">목록</a>
</div>
<table class="table_basic">
	<caption> <?=$complainData['menu_title']?> | 평가의견수 : <?php echo $complainData['total'];?> | 평균점수 : <?=$complainData['average']?></caption>
	<colgroup>
	<col width="10%" />
	<col width="10%" />
	<col width="50%" />
	<col width="10%" />
	<col width="10%" />
	<col width="10%" />
	</colgroup>
	<thead>
		<tr>
			<th>작성자 아이디</th>
			<th>평가점수</th>
			<th>의견내용</th>
			<th>등록시간</th>
			<th>IP</th>
			<th>삭제</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$dbData = $complainData['data'];
		for($i = 0; $i < count($dbData); $i++){
			
		?>
		<tr>
			<td><?php echo $dbData[$i]['uid']?></td>
			<td><?php echo $dbData[$i]['point']?></td>
			<td class="tleft" style="padding-left:5px"><?php echo $dbData[$i]['complain']?></td>
			<td><?php echo $dbData[$i]['writetime']?></td>
			<td><?php echo $dbData[$i]['ip']?></td>
			<td><a href="<?=SKIN_URL?>delete.php?no=<?php echo $dbData[$i]['indexcode']?>&backUrl=<?php echo urlencode(getBackUrl('menu|mode|limit|site|order|no', 1))?>" class="in_btn btn_delete delete_complain">삭제</a></td>
		</tr>
		<?php }?>
		<?php if(count($dbData) == 0){?>
		<tr>
			<td colspan="6">등록된 민원사항이 없습니다.</td>
		</tr>
		<?php }?>
	</tbody>
</table>
<?php include 'pagination.inc.php';?>
<div class="function mt20">
	<a href="<?php echo getBackUrl('menu|limit|site|order')?>" class="btn btn-default">목록</a>
</div>