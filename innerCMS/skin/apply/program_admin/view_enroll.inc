<?php 
$applyData = $system['data']['applyData'];
$config = $system['data']['config'];
$useData = $PROGRAM->getUseColumn($config, 'apply');
?>
<div class="function mt30">
	<a href="<?=$_skin?>enroll_exceldown.php?no=<?=$_GET['no']?>" class="btn btn-default">엑셀 다운로드</a>
</div>

<table class="table_basic mt50 th-g">
	<caption>신청자 정보 보기</caption>
<!-- 	<colgroup> -->
<!-- 	<col width="10%" /> -->
<!-- 	<col width="40%" /> -->
<!-- 	<col width="10%" /> -->
<!-- 	<col width="40%" /> -->
<!-- 	</colgroup> -->
	<thead>
	<tr>
		<th>번호</th>
		<th>성명</th>
		<th>휴대폰</th>
		<th>이메일</th>
		<?php foreach($useData as $value){?>
		<th><?=$value?></th>
		<?php }?>
		<?php if(isset($config['finish_check_type']) && $config['finish_check_type'] == 1){?>
		<th>참여인원</th>
		<?php }?>
		<th>첨부파일</th>
		<th>승인여부</th>
		<th>신청내역삭제</th>
	</tr>
	</thead>
	<tbody>
		<?php for($i = 0; $i < count($applyData); $i++){?>
		<tr>
			<td><?php echo $i+1?></td>
			<td><?php echo $applyData[$i]['name']?></td>
			<td><?php echo $applyData[$i]['phone']?></td>
			<td><?php echo $applyData[$i]['email'] != "@" ? $applyData[$i]['email'] : ""?></td>
			<?php foreach($useData as $key => $value){?>
			<td><?=$applyData[$i][$key] ?></td>
			<?php }?>
			<?php if(isset($config['finish_check_type']) && $config['finish_check_type'] == 1){?>
			<td><?php echo $applyData[$i]['num1']?>명</td>
			<?php }?>
			<td>
			
				<?php 
				$fileInfo = $SKIN->getFileData($sno, $applyData[$i]['indexcode'], 'attach');
				if(count($fileInfo) > 0)
				{
					for($j = 0; $j < count($fileInfo); $j++){
						$fileicon = getFileIcon($fileInfo[$j]['file_ext']);
				?>
				<img src="../common/img/file/<?php echo $fileicon['icon']?>" width="14" height="12" alt="icon">
				<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$fileInfo[$j]['file_id']?>" title="<?=$fileInfo[$j]['down_file_name']?> 파일 다운로드"><?=$fileInfo[$j]['down_file_name']?></a>
				<?
					}
				}
				?>
			</td>
			<td>
				<?php if($applyData[$i]['status'] == 0){?>
				<a href="<?=SKIN_URL?>status_change.php?no=<?php echo $applyData[$i]['indexcode']?>&status=1&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|sno|view|pno|category|limit|no|sfv", 1))?>" data-name="<?=$applyData[$i]['name']?>" data-status="승인" class="in_btn btn_off apply_change">미승인</a>
				<?php }else if($applyData[$i]['status'] == 1){?>
				<a href="<?=SKIN_URL?>status_change.php?no=<?php echo $applyData[$i]['indexcode']?>&status=0&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|sno|view|pno|category|limit|no|sfv", 1))?>" data-name="<?=$applyData[$i]['name']?>" data-status="미승인" class="in_btn btn_on apply_change">승인</a>
				<?php }?>
			</td>
			<td>
				<a href="<?=SKIN_URL?>apply_delete.php?menu=<?=$menuID?>&amp;no=<?php echo $applyData[$i]['indexcode']?>&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|sno|view|pno|category|limit|no|sfv", 1))?>" class="in_btn apply_delete btn_delete">삭제</a>
			</td>
		</tr>
		<?php }?>
		
		<?php if(count($applyData) == 0){?>
		<td colspan="11">신청내역이 없습니다.</td>
		<?php }?>
		
		
	</tbody>
</table>