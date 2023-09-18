<?php 
if($sno == 0) {
    echo '<div>프로그램 스킨이 적용된 메뉴가 없습니다. <a href="route.php?action=menuinfo" style="color:red">메뉴관리</a>에서 스킨 설정을 적용해 주세요.(스킨명 : apply/program)</div>';
    return;
}
include "menu.inc.php";
$dbData = $system['data']['dbData'];
?>
<div class="function mt30">
	<?php if($userID == 'inner'){?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|sno")?>&amp;mode=setting">설정</a>
	<?php }?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|sno")?>&amp;mode=write">프로그램 등록</a>
</div>
<table class="table_basic th-g">
	<caption>프로그램 리스트 (<?=$system['data']['menu_title']?>)</caption>
	<thead>
		<tr>
			<th>번호</th>
			<th>프로그램명</th>
			<?php if($reservUseCheck){?>
			<th>접수기간</th>
			<?php }?>
			<?php if($_SKIN->categoryUse){?>
			<th>카테고리</th>
			<?php }?>
			<th>진행기간</th>
			<?php if($reservUseCheck){?>
			<th>정원</th>
			<th>신청건수</th>
			<th>참여인원</th>
			<th>신청인원</th>
			<?php }?>
			<th>보기</th>
			<th>수정</th>
			<th>삭제</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i = 0; $i < count($dbData); $i++){
		$_viewLink = getBackUrl("menu")."&amp;mode=view&amp;no=".$dbData[$i]['indexcode']."&amp;sno=".$sno;
		$_updateLink = getBackUrl("menu")."&amp;mode=update&amp;no=".$dbData[$i]['indexcode']."&amp;sno=".$sno;
	?>
	<tr>
		<th><?=$pagenumstart - $i?></th>
		<td><a href="<?=$_viewLink?>" title="<?=$dbData[$i]['subject']?> 내용 보기"><?=strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum)?></a></td>
		<?php if($reservUseCheck){?>
		<td><?=$dbData[$i]['datetime1']?> ~ <?=$dbData[$i]['datetime2']?></td>
		<?php }?>
		<?php if($_SKIN->categoryUse){?>
		<td><?=$dbData[$i]['category']?></td>
		<?php }?>
		<td><?=$PROGRAM->getProgressDateText($dbData[$i])?></td>
		<?php if($reservUseCheck){?>
		<td><?=$dbData[$i]['total']?></td>
		<td><?=$PROGRAM->getApplyRowNum($dbData[$i]['indexcode'])?></td>
		<td><?=$PROGRAM->getApplyEnterNum($dbData[$i]['indexcode'])?></td>
		<td><?=$PROGRAM->getCurrentNum($system['data']['config'], $dbData[$i]['indexcode'])?></td>
		<?php }?>
		<td><a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a></td>
		<td><a href="<?=$_updateLink?>" class="in_btn btn_modify">수정</a></td>
		<td><a href="<?=SKIN_URL?>delete.php?menu=<?=$menuID?>&no=<?=$dbData[$i]['indexcode']?>&backUrl=<?=base64_encode(getBackUrl("menu|sno|sv", 1))?>" class="in_btn btn_delete program_delete">삭제</a></td>
	</tr>
	<?php }?>
	</tbody>
</table>

<?php include "pagination.inc.php"?>

<div class="function mt30">
	<?php if($userID == 'inner'){?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|sno")?>&amp;mode=setting">설정</a>
	<?php }?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|sno")?>&amp;mode=write">프로그램 등록</a>
</div>
