<?php
$dbData = $system['data']['dbData'];
$imageData = $system['data']['imageData'];
$writeColumn = isset($bannerInfo['writeColumn']) && $bannerInfo['writeColumn'] != "" ? explode("|", $bannerInfo['writeColumn']) : null;
?>
<table class="table_basic">
	<caption>배너 정보 보기</caption>
	<colgroup>
		<col width="20%"/>
		<col width="80%"/>
	</colgroup>
	<tbody>
		<?php if(in_array('site', $writeColumn)){?>
		<tr>
			<th>사이트</th>
			<td class="tleft">
			<?=$system['siteList'][$dbData['site']]['author']?>
			</td>
		</tr>	
		<?php }?>
		
		<?php if(in_array('tag', $writeColumn)){?>
		<tr>
			<th>태그명</th>
			<td class="tleft"><?php echo $dbData['title']?></td>
		</tr>
		<?php }?>
		
		<?php if(in_array('title', $writeColumn)){?>
		<tr>
			<th>배너 제목</th>
			<td class="tleft"><?php echo $dbData['title']?></td>
		</tr>
		<?php }?>
		
		<?php if(in_array('subtitle', $writeColumn)){?>
		<tr>
			<th>배너 소제목</th>
			<td class="tleft"><?php echo $dbData['subtitle']?></td>
		</tr>
		<?php }?>
		
		<?php if(in_array('link', $writeColumn)){?>
		<tr>
			<th>배너 링크</th>
			<td class="tleft"><?php echo $dbData['link']?></td>
		</tr>
		<?php }?>
		
		<?php if(in_array('memo', $writeColumn)){?>
		<tr>
			<th>배너 내용</th>
			<td class="tleft"><?php echo htmlspecialchars_decode($dbData['memo'])?></td>
		</tr>
		<?php }?>
		
		<?php if(in_array('term', $writeColumn)){?>
		<tr>
			<th>배너기간</th>
			<td class="tleft">
				<?php echo $dbData['start_date']?> ~ <?php echo $dbData['end_date']?> 
			</td>
		</tr>
		<?php }?>
		
		<?php if(in_array('target', $writeColumn)){?>
		<tr>
			<th>배너 새창</th>
			<td class="tleft">
				<?=$dbData['link_target'] == "S" ? "현재창" : "새창"?>
			</td>
			
		</tr>
		<?php }?>
		
		<?php if(in_array('stop', $writeColumn)){?>
		<tr>
			<th>배너중지</th>
			<td class="tleft">
				<?=$dbData['isstop'] == 1 ? "중지 " : ""?>
			</td>
		</tr>
		<?php }?>
		
		<?php if(in_array('image', $writeColumn) && $imageData != null){
			$fileicon = getFileIcon($imageData[0]['file_ext']);
			$imageSize = isset($bannerInfo['imageSize']) && $bannerInfo['imageSize'] != '' ? explode("*", $bannerInfo['imageSize']) : explode( "*", "150*150");
			$width = $imageSize[0];
			$height = $imageSize[1];
		?>
		<tr>
			<th>배너이미지</th>
			<td colspan="3" class="tleft">
				<img src="../data/upload/<?=$imageData[0]['attach_file_name']?>" style="width:<?=$width?>px" alt="<?=$dbData['title']?> 섬네일 파일" />
			</td>
		</tr>
		<?php }?>
		
	</tbody>
</table>

<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu|type|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write" title="배너등록">배너등록</a>
	<a class="btn btn_modify" href="<?=getBackUrl("menu|type|no|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=update">수정</a>
	<a class="btn btn_delete banner_delete" href="<?=SKIN_URL?>delete.php?menu=<?=$menuID?>&no=<?=$dbData['banner_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|type|pno|category|limit|opt", 1))?>">삭제</a>
	<a class="btn btn-default" href="<?=getBackUrl("menu|type|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
</div>