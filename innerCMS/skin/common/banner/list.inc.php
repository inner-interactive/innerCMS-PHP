<?php 
$dbData = $system['data']['dbData'];
$headerText = isset($bannerInfo['listHeaderText']) && $bannerInfo['listHeaderText'] != "" ? explode("|", $bannerInfo['listHeaderText']) : null;
$listColumn = isset($bannerInfo['listColumn']) && $bannerInfo['listColumn'] != "" ? explode("|", $bannerInfo['listColumn']) : null;
?>

<ul class="tabs">
<?php foreach($bannerConfig as $key => $value){?>
	<li<?=$type == $key ? " class=\"active\"" : ""?>><a href="<?=getBackUrl('menu|pno')?>&type=<?=$key?>"><?=$value['title']?></a></li>
<?php }?>
</ul>

<div class="function mt30">
	<?php if(count($dbData) > 0){?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|type")?>&amp;mode=arrange">순서정렬</a>
	<?php }?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|type")?>&amp;mode=write">배너등록</a>
</div>


<table class="table_basic th-g">
	<caption><?=$bannerInfo['title']?> 리스트</caption>
<!-- 	<colgroup> -->
<!-- 		<col width="5%" /> -->
<!-- 		<col width="15%" /> -->
<!-- 		<col width="40%" /> -->
<!-- 		<col width="10%" /> -->
<!-- 		<col width="15%" /> -->
<!-- 		<col width="10%" /> -->
<!-- 		<col width="5%" /> -->
<!-- 	</colgroup> -->
	<thead>
		<tr>
			<th>번호</th>
			<?php
			if(count($headerText) > 0){
				foreach($headerText as $value){
			?>
			<th><?=$value?></th>
			<?php }
			}
			?>
		</tr>
	</thead>
	<tbody>
	<?php 
	for($i = 0; $i < count($dbData); $i++){
		$_viewLink = getBackUrl("menu|type")."&amp;mode=view&amp;no=".$dbData[$i]['banner_id'];
		$thumbData = $SKIN->getFileData($menuID, $dbData[$i]['banner_id'], $type);
	?>
	<tr>
		<th><?=$pagenumstart - $i?></th>
		<?php 
		if(count($listColumn) > 0){
			foreach($listColumn as $column){
				switch ($column){
					
					
					case 'site':
					?>
					<td><?=$system['siteList'][$dbData[$i]['site']]['author']?></td>
					<?php 						
					break;
					
					case 'title':
					?>
					<td><a href="<?=$_viewLink?>" title="<?=$dbData[$i]['title']?> 내용 보기"><?=nl2br($dbData[$i]['title'])?></a></td>
					<?php 						
					break;
					
					case 'subtitle':
					?>
					<td><?=$dbData[$i]['subtitle']?></td>
					<?php 						
					break;
					
					case 'image':
					?>
					<td><img src="../data/upload/<?=$thumbData[0]['attach_file_name']?>" style="width:1000px" alt="섬네일 파일" /></td>
					<?php 						
					break;
					
					case 'link':
					?>
					<td>
						<?php if($dbData[$i]['link'] != ""){?>
						<a href="<?=$dbData[$i]['link']?>" target="_blank"><?=$dbData[$i]['link']?></a>
						<?php }?>
					</td>
					<?php 						
					break;
					
					case 'term':
					?>
					<td><?=$dbData[$i]['start_date']?> ~ <?=$dbData[$i]['end_date']?></td>
					<?php 						
					break;
					
					case 'state':
					?>
					<td><?=$dbData[$i]['isstop'] == 1 ? "중지" : ""?></td>
					<?php 						
					break;
					
					
					case 'view':
					?>
					<td><a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a></td>
					<?php 						
					break;
					
					
					case 'delete':
					?>
					<td><a class="in_btn btn_delete banner_delete" href="<?=SKIN_URL?>delete.php?menu=<?=$menuID?>&no=<?=$dbData[$i]['banner_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|type", 1))?>">삭제</a></td>
					<?php 						
					break;
					
					case 'dday':
					?>
					<td><?=$dbData[$i]['start_date']?></td>
					<?php 						
					break;
					
					case 'ddaystate':
						$dday = getDday($dbData[$i]['start_date']);
						$dday_txt = $dday > 0 ? $dday."일 남았습니다." : abs($dday)."일 지났습니다.";
					?>
					<td><?=$dday_txt?></td>
					<?php 						
					break;
					
					
					
					default:
						break;
				}
			}
		?>
		
		<?php }?>
		
		
	</tr>
	<?php }?>
	</tbody>
</table>

<?php include "pagination.inc.php"?>

<div class="function mt30">
	<?php if(count($dbData) > 0){?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|type")?>&amp;mode=arrange">순서정렬</a>
	<?php }?>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|type")?>&amp;mode=write">배너등록</a>
</div>
