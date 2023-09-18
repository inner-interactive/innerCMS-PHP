<?php
$configData = $system['data']['config'];
$dbData = $system['data']['dbData'];
$thumbData = $system['data']['thumbData'];
$picData = $system['data']['picData'];
$files1Data = $system['data']['files1Data'];
$files2Data = $system['data']['files2Data'];

	if($mode == "update")
	{
		$st_date = substr($dbData['datetime1'],0,10);
		$st_hour = substr($dbData['datetime1'],11,2);
		$st_minute = substr($dbData['datetime1'],14,2);
	
		$ed_date = substr($dbData['datetime2'],0,10);
		$ed_hour = substr($dbData['datetime2'],11,2);
		$ed_minute = substr($dbData['datetime2'],14,2);
	
	}else {
		$st_date = $st_hour = $st_minute = $ed_date = $ed_hour = $ed_minute = $progress_date = $progress_hour = $progress_minute = '';
	}

?>
<table class="table_basic mt50 th-g">
	<caption>프로그램 필수 정보 입력</caption>
	<colgroup>
	<col width="10%" />
	<col width="40%" />
	<col width="10%" />
	<col width="40%" />
	</colgroup>
	<tbody>
		<tr>
			<th><label for="subject">프로그램명</label></th>
			<td class="tleft" colspan="3"><input type="text" id="subject" name="subject" value="<?php echo $dbData['subject']?>" class="inputs" style="width:90%"/></td>
		</tr>
		<?php if($reservUseCheck){?>
		<tr>
			<th>접수기간</th>
			<td class="tleft">
				<input type="text" name="st_date" id="st_date" class="datepicker inputs" style="width:100px" value="<?php echo $st_date?>" />
					
				<select name="st_hour" class="inputs">
					<?php for($i = 0; $i < 24; $i++){?>
					<option value="<?php echo $i?>" <?php echo isselected($i,intval($st_hour)) ?>><?php echo $i?></option>
					<?php }?>
				</select>시
				
				<select name="st_minute" class="inputs">
					<?php for($i = 0; $i < 60; $i = $i + 10){?>
					<option value="<?php echo $i?>" <?php echo isselected($i,intval($st_minute)) ?>><?php echo $i?></option>
					<?php }?>
				</select>분
				~
				<input type="text" name="ed_date" id="ed_date" class="datepicker inputs" style="width:100px" value="<?php echo $ed_date?>" />
				
				<select name="ed_hour" class="inputs">
					<?php for($i = 0; $i < 24; $i++){?>
					<option value="<?php echo $i?>" <?php echo isselected($i,intval($ed_hour)) ?>><?php echo $i?></option>
					<?php }?>
				</select>시
				
				<select name="ed_minute" class="inputs">
					<?php for($i = 0; $i < 60; $i = $i + 10){?>
					<option value="<?php echo $i?>" <?php echo isselected($i,intval($ed_minute)) ?>><?php echo $i?></option>
					<?php }?>
				</select>분
			</td>
		</tr>
		<?php }?>
		<?php  if(count($categoryData) > 0){?>
		<tr>
			<th><label for="category">카테고리</label></th>
			<td class="tleft"><select id="category" name="category">
					<?php  for($i = 0; $i < count($categoryData); $i++){?>
						<option value="<?=$categoryData[$i]?>" <?=isselected($categoryData[$i], $dbData['category'])?>><?=$categoryData[$i]?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<?php }?>
		<tr>
			<th>진행기간</th>
			<td class="tleft">
				<span>
					<input type="radio" id="ptype1" name="ptype" <?=ischecked(0, $dbData['ptype'])?> value="0" />
					<label for="ptype1">날짜입력</label>
					<input type="text" name="date1" id="date1" class="datepicker inputs" style="width:100px" value="<?php echo $dbData['date1'] != "0000-00-00" ? $dbData['date1'] : ""?>" autocomplete="off" /> ~ 
					<input type="text" name="date2" id="date2" class="datepicker inputs" style="width:100px" value="<?php echo $dbData['date2'] != "0000-00-00" ? $dbData['date2'] : ""?>" autocomplete="off"  />
				</span>
				
				<span style="margin-left:20px">
					<input type="radio" id="ptype2" name="ptype" <?=ischecked(1, $dbData['ptype'])?> value="1" />
					<label for="ptype2">텍스트 입력</label>
					<input type="text" name="ptext" id="ptext" value="<?php echo $dbData['ptext']?>" class="inputs"  />
				</span>
			</td>
		</tr>
		<?php if($reservUseCheck){?>
		<tr>
			<th><label for="total">정원</label></th>
			<td colspan="3" class="tleft">
				<input type="text" name="total" id="total" value="<?php echo $dbData['total']?>" class="inputs" style="width:50px" />명
				
			</td>
		</tr>
		<?php }?>
		
		<tr style="display:none">
			<th>메뉴 선택</th>
			<td colspan="3" class="tleft">
			<select name="site_menuid" id="site_menuid">
			<?php foreach($menuData as $value){
				$site_menuid = intval($value['site_menuid']);
				$positionArr = $MENU->getPositionArray($value['site_menuid']);
				$menu_txt = $MENU->makePositionHtml($positionArr, true);
				?>
			<option value="<?=$site_menuid?>"><?=$menu_txt?></option>
			<?php }?>
			</select>
			</td>
		</tr>
		
		</tbody>
</table>


<table class="table_basic mt50 th-g">
	<caption>프로그램 추가 정보 입력</caption>
	<colgroup>
		<col width="10%" />
		<col width="40%" />
		<col width="10%" />
		<col width="40%" />
	</colgroup>
	<tbody>
		<?php 
		$useData = $PROGRAM->getUseColumn($configData);
		$i = 0;
		foreach($useData as $key => $value){
			if($i % 2 == 0) echo "<tr>";
		?>
			<th><label for="<?=$key?>"><?=$value?></label></th>
			<td <?php if($i == count($useData) - 1 && count($useData) % 2 == 1){?> colspan="3"<?php }?>class="tleft"><input type="text" name="<?=$key?>" id="<?=$key?>" value="<?=$dbData[$key]?>" class="inputs" style="width:300px" /></td>
		<?php
			if($i % 2 == 1) echo "</tr>";
			$i++;
		}?>
		<tr>
			<th>목표</th>
			<td colspan="3" style="padding:10px">
				<?php echo editor_html("etc", $dbData['etc']);?>
			</td>
		</tr>
		<tr>
			<th>내용</th>
			<td colspan="3" style="padding:10px">
				<?php echo editor_html("memo", $dbData['memo']);?>
			</td>
		</tr>
		
		
		<tr>
			<th>리스트 섬네일 업로드</th>
			<td class="tleft">
				<div class="insert">
					<ul>
						<li>
							<label for="tfile">사진 파일</label>
							<input class="upload-hidden" type="file" name="tfile" id="tfile" />
						</li>
				  </ul>
				</div>
				<p class="mt10 mb10">* 최대 첨부파일 용량은 <?=$SKIN->limitFileSizeTxt?> 입니다. 제한 용량을 초과하는 파일은 제외됩니다.</p>
				<p class="mt10 mb10">* 사진 사이즈는 <?=$thumbWidth?> * <?=$thumbHeight?>에 맞춰서 올려주세요.</p>
			</td>
			<th>업로드된 리스트 섬네일</th>
			<td class="tleft">
				<?php
				if(count($thumbData) > 0){
				?>
				<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$thumbData[0]['file_id']?>" title="<?=$thumbData[0]['down_file_name']?> 파일 다운로드"><img src="../data/upload/<?php echo $thumbData[0]['attach_file_name']?>" width="<?php echo $thumbWidth?>" height="<?php echo $thumbHeight?>" alt="" /></a>
				<a href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$thumbData[0]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|sfv"))?>" class="delfile in_btn btn_delete" title="<?=$thumbData[0]['down_file_name']?> 파일 삭제">삭제</a>
				<?php 	
				}
				?>
			</td>
		</tr>
		
		<tr>
			<th>사진 업로드</th>
			<td class="tleft">
				<div class="insert">
					<ul>
						<?php for($i = 1; $i <= 6; $i++){?>
						<li class="mt10 mb10 fleft wd50">
							<label for="pfile<?php echo $i?>">사진 파일<?php echo $i?></label>
							<input class="upload-hidden" type="file" name="pfile[]" id="pfile<?php echo $i?>" />
						</li>
						<?php }?>
				  </ul>
				</div>
				<p class="guide">* 최대 첨부파일 용량은 <?=$SKIN->limitFileSizeTxt?> 입니다. 제한 용량을 초과하는 파일은 제외됩니다.</p>
			</td>
			<th>업로드된 사진</th>
			<td class="tleft">
			<?php
				if(count($picData) > 0){
				?>
				<ul>
					<?php for($i = 0; $i < count($picData); $i++){?>
					<li class="mt10 mb10 fleft wd50">
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$picData[$i]['file_id']?>" title="<?=$picData[$i]['down_file_name']?> 파일 다운로드"><img src="../data/upload/<?php echo $picData[$i]['attach_file_name']?>" width="<?php echo $SKIN->thumbnailWidth?>" height="<?php echo $SKIN->thumbnailHeight?>" alt="" /></a>
						<a href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$picData[$i]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|sfv"))?>" class="delfile in_btn btn_delete" title="<?=$picData[$i]['down_file_name']?> 파일 삭제">삭제</a>
					</li>
					<?php }?>
			  </ul>
				  
				<?php 	
				}
				?>
			</td>
		</tr>
		
		
		<tr>
			<th>첨부파일 업로드</th>
			<td class="tleft">
			
				<div class="insert">
					<ul>
					<?php for($i = 1; $i <= 4; $i++){?>
						<li class="mt10 mb10 fleft wd50">
							<label for="sfile<?php echo $i?>">첨부 파일<?php echo $i?></label>
							<input class="upload-hidden" type="file" name="sfile[]" id="sfile<?php echo $i?>" />
						</li>
						<?php }?>
						
				  </ul>
				</div>
				<p class="guide">* 최대 첨부파일 용량은 <?=$SKIN->limitFileSizeTxt?> 입니다. 제한 용량을 초과하는 파일은 제외됩니다.</p>
			
			</td>
			<th>업로드된 첨부파일</th>
			<td class="tleft">
			<?php
				if(count($files1Data) > 0){
				?>
				<ul>
					<?php for($i = 0; $i < count($files1Data); $i++){?>
					<li class="mt10 mb10 fleft wd50">
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$files1Data[$i]['file_id']?>" title="<?=$files1Data[$i]['down_file_name']?> 파일 다운로드"><?=$files1Data[$i]['down_file_name']?></a>
						<a href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$files1Data[$i]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|sfv"))?>" class="delfile in_btn btn_delete" title="<?=$files1Data[$i]['down_file_name']?> 파일 삭제">삭제</a>
					</li>
					<?php }?>
			  </ul>
				  
				<?php 	
				}
				?>
			</td>
		</tr>
		
		
		<tr>
			<th>신청파일 업로드</th>
			<td class="tleft">
			
				<div class="insert">
					<ul>
					<?php for($i = 1; $i <= 4; $i++){?>
						<li class="mt10 mb10 fleft wd50">
							<label for="sfile2<?php echo $i?>">첨부 파일<?php echo $i?></label>
							<input class="upload-hidden" type="file" name="sfile2[]" id="sfile2<?php echo $i?>" />
						</li>
						<?php }?>
						
				  </ul>
				</div>
				<p class="guide">* 최대 첨부파일 용량은 <?=$SKIN->limitFileSizeTxt?> 입니다. 제한 용량을 초과하는 파일은 제외됩니다.</p>
			
			</td>
			<th>업로드된 신청파일</th>
			<td class="tleft">
			<?php
				if(count($files2Data) > 0){
				?>
				<ul>
					<?php for($i = 0; $i < count($files2Data); $i++){?>
					<li class="mt10 mb10 fleft wd50">
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$files2Data[$i]['file_id']?>" title="<?=$files2Data[$i]['down_file_name']?> 파일 다운로드"><?=$files2Data[$i]['down_file_name']?></a>
						<a href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$files2Data[$i]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|sfv"))?>" class="delfile in_btn btn_delete" title="<?=$files2Data[$i]['down_file_name']?> 파일 삭제">삭제</a>
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





<script type="text/javascript">
$('.editor_form').submit(function(){
	<?php 
		echo get_editor_js('etc');
		echo get_editor_js('memo');
	?>
});
</script>
