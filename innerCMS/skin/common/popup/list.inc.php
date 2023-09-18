<?php 
$dbData = $system['data']['dbData'];
?>
<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu")?>&amp;mode=write">팝업등록</a>
</div>
<table class="table_basic th-g">
	<caption>팝업 리스트</caption>
	<colgroup>
	<col width="5%" />
	<col width="15%" />
	<col width="40%" />
	<col width="10%" />
	<col width="15%" />
	<col width="10%" />
	<col width="5%" />
	</colgroup>
	<thead>
		<tr>
			<th>번호</th>
			<th>사이트</th>
			<th>제목</th>
			<th>팝업형태</th>
			<th>팝업기간</th>
			<th>팝업상태</th>
			<th>보기</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i = 0; $i < count($dbData); $i++){
		$_viewLink = getBackUrl("menu")."&amp;mode=view&amp;no=".$dbData[$i]['pop_id'];
		$_stop = $dbData[$i]['isstop'] == 1 ? true : false;
		$_state = "";
		if($_stop == false)
		{
			if($dbData[$i]['start_date'] <= date("Y-m-d") && $dbData[$i]['end_date'] >= date("Y-m-d")){ 
				$_stop = false; 
			}else{
				$_stop = true;
				$_state = "기간아님";
			}
		}else{
			$_state = "팝업중지";
		}
	?>
	<tr>
		<th><?=$pagenumstart - $i?></th>
		<td><?=$system['siteList'][$dbData[$i]['site']]['author']?></td>
		<td><a href="<?=$_viewLink?>" title="<?=$dbData[$i]['subject']?> 내용 보기"<?php if($_stop){?> style="color:#eee;"<?php }?>><?=strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum)?></a></td>
		<td><?php 

		if($dbData[$i]['pop_type'] == 'popup'){
		    echo '팝업창';
		}else if($dbData[$i]['pop_type'] == 'layer'){
		    echo '레이어';
		}else if($dbData[$i]['pop_type'] == 'intro'){
		    echo '인트로';
		}
        ?></td>
		<td><?=$dbData[$i]['start_date']?> ~ <?=$dbData[$i]['end_date']?></td>
		<td><?=$_state?></td>
		<td><a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a></td>
	</tr>
	<?php }?>
	</tbody>
</table>

<?php include "pagination.inc.php"?>

<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu")?>&amp;mode=write">팝업등록</a>
</div>
