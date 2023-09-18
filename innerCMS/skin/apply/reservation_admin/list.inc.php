<?php 
$dbData = $system['data']['dbData'];
?>
<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu|sno")?>&amp;mode=write">예약시설 등록</a>
</div>
<table class="table_basic th-g">
	<caption>예약시설 리스트</caption>
	<thead>
		<tr>
			<th>번호</th>
			<th>시설명</th>
			<?php if($SKIN->categoryUse){?>
			<th>카테고리</th>
			<?php }?>
			<th>시설정보</th>
			<th>예약정보</th>
			<th>삭제</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i = 0; $i < count($dbData); $i++){
		$_viewLink = getBackUrl("menu")."&amp;mode=view&amp;no=".$dbData[$i]['indexcode'];
		$_reservationLink = getBackUrl("menu")."&amp;mode=reservation_list&amp;no=".$dbData[$i]['indexcode'];
		$_updateLink = getBackUrl("menu")."&amp;mode=update&amp;no=".$dbData[$i]['indexcode'];
		$_updateLink2 = getBackUrl("menu")."&amp;mode=update&amp;fmode=reservation&amp;no=".$dbData[$i]['indexcode'];
	?>
	<tr>
		<th><?=$pagenumstart - $i?></th>
		<td><a href="<?=$_viewLink?>" title="<?=$dbData[$i]['subject']?> 내용 보기"><?=strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum)?></a></td>
		<?php if($SKIN->categoryUse){?>
		<td><?=$dbData[$i]['category']?></td>
		<?php }?>
		<td>
			<a href="<?=$_updateLink?>" class="in_btn btn_modify">수정</a>
			<a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a>
		</td>
		<td>
			<a href="<?=$_updateLink2?>" class="in_btn btn_on">수정</a>
			<a href="<?=$_reservationLink?>" class="in_btn btn_view">보기</a>
		</td>
		<td><a href="<?=SKIN_URL?>delete.php?menu=<?=$menuID?>&no=<?=$dbData[$i]['indexcode']?>&backUrl=<?=base64_encode(getBackUrl("menu|sno|sv", 1))?>" class="in_btn btn_delete fc_delete">삭제</a></td>
	</tr>
	<?php }?>
	</tbody>
</table>

<?php include "pagination.inc.php"?>

<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu|sno")?>&amp;mode=write">예약시설 등록</a>
</div>
