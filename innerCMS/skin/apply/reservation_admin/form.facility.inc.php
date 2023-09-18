<table class="table_basic mt50 th-g">
	<caption>예약시설 정보 입력</caption>
	<colgroup>
	<col width="10%" />
	<col width="40%" />
	<col width="10%" />
	<col width="40%" />
	</colgroup>
	<tbody>
	
		<?php  if($SKIN->categoryUse){?>
		<tr>
			<th><label for="category">카테고리</label></th>
			<td class="tleft"><select id="category" name="category">
					<?php  for($i = 0; $i < count($SKIN->categoryList); $i++){?>
						<option value="<?=$SKIN->categoryList[$i]?>"
						<?=isselected($SKIN->categoryList[$i], $dbData[0]['category'])?>><?=$SKIN->categoryList[$i]?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<?php }?>
		
		<tr>
			<th><label for="subject">예약 시설명</label></th>
			<td class="tleft" colspan="3"><input type="text" id="subject" name="subject" value="<?php echo $dbData['subject']?>" class="inputs" style="width:90%" /></td>
		</tr>
		<tr>
			<th>주소</th>
			<td class="tleft" colspan="3">
				
    			<div class="mb10">
        			<label for="zipcode" class="pd5">우편번호</label><input type="text" name="zipcode" id="zipcode" value="<?php echo $dbData['zipcode']?>" class="inputs w100" />
        			<button type="button" class="in_btn btn_apply" id="zipsearch">주소검색</button>
    			</div>
    			<div class="mb10">
    				<label for="address" class="pd5">기본주소</label><input type="text" name="address" id="address" value="<?php echo $dbData['address']?>" class="inputs pd5 wd50" />
				</div>
    			<div class="mb10">
    				<label for="address2" class="pd5">상세주소</label><input type="text" name="address2" id="address2" value="<?php echo $dbData['address2']?>" class="inputs wd50" />
    				</div>
    			<div class="mb10" style="display:none">
    				<label for="address3" class="pd5">참고항목</label><input type="text" name="address3" id="address3" value="<?php echo $dbData['address3']?>" class="inputs wd50" />
    				<input type="hidden" name="address_type" id="address_type" value="" class="inputs w100">
				</div>
			</td>
		</tr>
	
		<tr>
			<th><label for="location">위치</label></th>
			<td class="tleft">
				<input type="text" name="location" id="location" value="<?php echo $dbData['location']?>" class="inputs wd50" placeholder="ex) A동 건물 2층" />
			</td>
			<th><label for="size">면적</label></th>
			<td class="tleft">
				<input type="text" name="size" id="size" value="<?php echo $dbData['size']?>" class="inputs wd50" placeholder="ex) 200㎡" />
			</td>
		</tr>
		
		<tr>
			<th><label for="max_person">수용인원</label></th>
			<td class="tleft">
				<input type="text" name="max_person" id="max_person" value="<?php echo $dbData['max_person']?>" class="inputs wd50" placeholder="ex) 10명" />
			</td>
			<th><label for="apply_way">접수방법</label></th>
			<td class="tleft">
				<input type="text" name="apply_way" id="apply_way" value="<?php echo $dbData['apply_way']?>" class="inputs wd50" placeholder="ex) 온라인, 방문접수" />
			</td>
		</tr>
		
		</tbody>
</table>


<table class="table_basic mt50 th-g">
	<caption>담당자 정보 입력</caption>
	<colgroup>
	<col width="10%" />
	<col width="40%" />
	<col width="10%" />
	<col width="40%" />
	</colgroup>
	<tbody>
	
		<tr>
			<th><label for="admin_name">담당자 성명</label></th>
			<td class="tleft"><input type="text" id="admin_name" name="admin_name" value="<?php echo $dbData['admin_name']?>" class="inputs w100" /></td>
			<th><label for="admin_phone">담당자 연락처</label></th>
			<td class="tleft"><input type="text" id="admin_phone" name="admin_phone" value="<?php echo $dbData['admin_phone']?>" class="inputs w200"  /></td>
		</tr>
		<tr>
			<th><label for="admin_email">담당자 이메일</label></th>
			<td class="tleft" colspan="3"><input type="text" id="admin_email" name="admin_email" value="<?php echo $dbData['admin_email']?>" class="inputs w300" /></td>
		</tr>
	</tbody>
</table>




<table class="table_basic mt50 th-g">
	<caption>예약시설상세정보</caption>
	<colgroup>
		<col width="10%" />
		<col width="40%" />
		<col width="10%" />
		<col width="40%" />
	</colgroup>
	<tbody>
		<tr>
			<th>시설현황</th>
			<td colspan="3"  style="padding:10px">
				<?php echo editor_html("memo1", $dbData['memo1']);?>
			</td>
		</tr>
		<tr>
			<th>이용요금</th>
			<td colspan="3" style="padding:10px">
				<?php echo editor_html("memo2", $dbData['memo2']);?>
			</td>
		</tr>
		<tr>
			<th>사용자준수사항</th>
			<td colspan="3" style="padding:10px">
				<?php echo editor_html("memo3", $dbData['memo3']);?>
			</td>
		</tr>
	</tbody>
</table>


<table class="table_basic mt50 th-g">
	<caption>예약시설 사진 및 첨부파일 등록</caption>
	<colgroup>
		<col width="10%" />
		<col width="40%" />
		<col width="10%" />
		<col width="40%" />
	</colgroup>
	<tbody>
		
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
    echo get_editor_js('memo1');
    echo get_editor_js('memo2');
    echo get_editor_js('memo3');
	?>
});
</script>
<?php echo POSTCODE_JS?>


