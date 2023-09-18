<?php 
$dbData = $system['data']['dbData'];
$thumbData = $system['data']['thumbData'];
$picData = $system['data']['picData'];
$files1Data = $system['data']['files1Data'];
$files2Data = $system['data']['files2Data'];

?>

<table class="table_basic mt50 th-g">
	<caption>예약시설정보</caption>
	<colgroup>
	<col width="10%" />
	<col width="40%" />
	<col width="10%" />
	<col width="40%" />
	</colgroup>
	<tbody>
	
		<?php  if($SKIN->categoryUse){?>
		<tr>
			<th>카테고리</th>
			<td colspan="3" class="tleft"><?=$dbData['category']?></td>
		</tr>
		<?php }?>
		<tr>
			<th>예약시설명</th>
			<td colspan="3" class="tleft">
				<?php echo $dbData['subject']?>
			</td>
		</tr>
		<tr>
			<th>주소</th>
			<td class="tleft">
				<?=$dbData['zipcode'] != "" ? "(".$dbData['zipcode'].")" : ""?>
				<?=$dbData['address']?>
				<?=$dbData['address2']?>
			</td>
		</tr>
		
		<tr>
			<th>위치</th>
			<td class="tleft">
				<?=$dbData['location']?>
			</td>
			<th>면적</th>
			<td class="tleft">
				<?=$dbData['size']?>
			</td>
		</tr>
		<tr>
			<th>수용인원</th>
			<td class="tleft">
				<?=$dbData['max_person']?>
			</td>
			<th>접수방법</th>
			<td class="tleft">
				<?=$dbData['apply_way']?>
			</td>
		</tr>
		
		<tr>
			<th>시설현황</th>
			<td colspan="3" class="tleft">
				<?php echo htmlspecialchars_decode($dbData['memo1'])?>
			</td>
		</tr>
		<tr>
			<th>이용요금</th>
			<td colspan="3" class="tleft">
				<?php echo htmlspecialchars_decode($dbData['memo2'])?>
			</td>
		</tr>
		<tr>
			<th>사용자준수사항</th>
			<td colspan="3" class="tleft">
				<?php echo htmlspecialchars_decode($dbData['memo3'])?>
			</td>
		</tr>
		
		
		<tr>
			<th>리스트 섬네일</th>
			<td class="tleft">
				<?php
				if(count($thumbData) > 0){
				?>
				<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$thumbData[0]['file_id']?>" title="<?=$thumbData[0]['down_file_name']?> 파일 다운로드"><img src="../data/upload/<?php echo $thumbData[0]['attach_file_name']?>" width="<?php echo $SKIN->thumbnailWidth?>" height="<?php echo $SKIN->thumbnailHeight?>" alt="" /></a>
				<?php 	
				}
				?>
			</td>
			<th>사진파일</th>
			<td class="tleft">
			<?php
				if(count($picData) > 0){
				?>
				<ul>
					<?php for($i = 0; $i < count($picData); $i++){?>
					<li class="mt10 mb10 fleft wd50">
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$picData[$i]['file_id']?>" title="<?=$picData[$i]['down_file_name']?> 파일 다운로드"><img src="../data/upload/<?php echo $picData[$i]['attach_file_name']?>" width="<?php echo $SKIN->thumbnailWidth?>" height="<?php echo $SKIN->thumbnailHeight?>" alt="" /></a>
					</li>
					<?php }?>
			  </ul>
				  
				<?php 	
				}
				?>
			</td>
		</tr>
		
		
		<tr>
			<th>첨부파일</th>
			<td class="tleft">
			<?php
				if(count($files1Data) > 0){
				?>
				<ul>
					<?php for($i = 0; $i < count($files1Data); $i++){?>
					<li class="mt10 mb10 fleft wd50">
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$files1Data[$i]['file_id']?>" title="<?=$files1Data[$i]['down_file_name']?> 파일 다운로드"><?=$files1Data[$i]['down_file_name']?></a>
					</li>
					<?php }?>
			  </ul>
				  
				<?php 	
				}
				?>
			</td>
			<th>신청파일</th>
			<td class="tleft">
			<?php
				if(count($files2Data) > 0){
				?>
				<ul>
					<?php for($i = 0; $i < count($files2Data); $i++){?>
					<li class="mt10 mb10 fleft wd50">
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$files2Data[$i]['file_id']?>" title="<?=$files2Data[$i]['down_file_name']?> 파일 다운로드"><?=$files2Data[$i]['down_file_name']?></a>
					</li>
					<?php }?>
			  </ul>
				  
				<?php 	
				}
				?>
			</td>
		</tr>
	</tbody>
</table>

<div class="function mt30">
	<a href="<?php echo getBackUrl("menu|sno|pno|category|limit|sfv|opt")?>&amp;mode=list" class="btn btn-default">목록</a>
	<a href="<?php echo getBackUrl("menu|no|sno|pno|category|limit|sfv|opt")?>&amp;mode=update" class="btn btn_modify">시설정보수정</a>
	<a href="<?php echo getBackUrl("menu|no|sno|pno|category|limit|sfv|opt")?>&amp;mode=update&amp;fmode=reservation" class="btn btn_on">예약정보수정</a>
	<a href="<?=SKIN_URL?>delete.php?menu=<?=$menuID?>&no=<?=$_GET['no']?>&backUrl=<?=base64_encode(getBackUrl("menu|sno", 1))?>" class="btn btn_delete fc_delete">삭제</a>
</div>
