<table class="table_basic mt50 th-g">
	<caption>프로그램 정보 보기</caption>
	<colgroup>
	<col width="10%" />
	<col width="40%" />
	<col width="10%" />
	<col width="40%" />
	</colgroup>
	<tbody>
		<tr>
			<th>프로그램명</th>
			<td colspan="3" class="tleft">
				<?php echo $dbData['subject']?>
				<?php
				if(false){
				$current_num = $PROGRAM->getCurrentNum($system['data']['config'], $dbData['indexcode']);
				$state = $PROGRAM->getProgramState($dbData['datetime1'], $dbData['datetime2'], $dbData['total'], $current_num);
				?>
				<span class="enroll_<?php echo $state['state']?>" style="width:64px;float:right"><?php echo $state['enroll']?></span>
				<?php }?>
			</td>
		</tr>
		<?php if($reservUseCheck){?>
		<tr>
			<th>접수기간</th>
			<td class="tleft">
				<?php echo $dbData['datetime1']?> ~ <?php echo $dbData['datetime2']?>
			</td>
		</tr>
		<?php }?>
		<?php  if(count($categoryData) > 0){?>
		<tr>
			<th>카테고리</th>
			<td colspan="3" class="tleft"><?=$dbData['category']?></td>
		</tr>
		<?php }?>
		<tr>
			<th>진행기간</th>
			<td colspan="3" class="tleft">
				<?php echo $PROGRAM->getProgressDateText($dbData)?>
			</td>
		</tr>
		<?php if($reservUseCheck){?>
		<tr>
			<th>정원</th>
			<td colspan="3" class="tleft">
				<?=$dbData['total']?>명 / <?=$PROGRAM->getCurrentNum($system['data']['config'], $dbData['indexcode'])?>명
			</td>
		</tr>
		<?php }?>
		
		<?php 
		$useData = $PROGRAM->getUseColumn($configData);
		$i = 0;
		foreach($useData as $key => $value){
			if($i % 2 == 0) echo "<tr>";
		?>
			<th><?=$value?></th>
			<td <?php if($i == count($useData) - 1 && count($useData) % 2 == 1){?> colspan="3"<?php }?>class="tleft"><?php echo $dbData[$key]?></td>
		<?php
			if($i % 2 == 1) echo "</tr>";
			$i++;
		}?>
		<tr>
			<th>목표</th>
			<td colspan="3" class="tleft">
				<?php echo htmlspecialchars_decode($dbData['etc'])?>
			</td>
		</tr>
		<tr>
			<th>내용</th>
			<td colspan="3" class="tleft">
				<?php echo htmlspecialchars_decode($dbData['memo'])?>
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