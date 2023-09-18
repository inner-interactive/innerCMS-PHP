<?php
$dbData = $system['data']['dbData'];
$imageData = $system['data']['imageData'];
$writeColumn = isset($bannerInfo['writeColumn']) && $bannerInfo['writeColumn'] != "" ? explode("|", $bannerInfo['writeColumn']) : null;
?>
<table class="table_basic">
	<caption><?=$bannerInfo['title']?> 내용 작성</caption>
	<colgroup>
		<col width="20%"/>
		<col width="80%"/>
	</colgroup>
	<tbody>
		<?php if(in_array('site', $writeColumn)){?>
		<tr>
			<th><label for="site">사이트 선택</label></th>
			<td class="tleft">
				<select name="site" id="site">
				<?php 
				foreach($system['siteList'] as $key => $value){
					if($key == 'innerCMS') continue;
				?>
				<option value="<?php echo $key?>" <?php echo isselected($key, $dbData['site'])?>><?php echo $value['author']?></option>
				<?php }?>
				</select>
			</td>
		</tr>
		<?php }?>
		
		
		<?php if(in_array('subtitle', $writeColumn)){?>
		<tr>
			<th><label for="subtitle">배너 소제목</label></th>
			<td class="tleft">
				<input type="text" id="subtitle" name="subtitle" value="<?php echo $dbData['subtitle']?>"class="inputs wd90" />
			</td>
		</tr>
		<?php }?>
		
		
		<?php if(in_array('title', $writeColumn)){?>
		<tr>
			<th><label for="title">배너 제목</label></th>
			<td class="tleft">
				<textarea name="title" id="title" cols="30" rows="10" class="inputs wd90" style="height:80px"><?=$dbData['title']?></textarea>
			</td>
		</tr>
		<?php }?>
		
		<?php if(in_array('tag', $writeColumn)){?>
		<tr>
			<th><label for="title">태그명</label></th>
			<td class="tleft"><input type="text" id="title" name="title" value="<?php echo $dbData['title']?>" class="inputs wd90" /></td>
		</tr>
		<?php }?>
		
		
		
		
		<?php if(in_array('memo', $writeColumn)){?>
		<tr>
			<th><label for="memo">배너 내용</label></th>
			<td class="tleft">
				<textarea name="memo" id="memo" cols="30" rows="10" class="inputs wd90" style="height:80px"><?=$dbData['memo']?></textarea>
			</td>
		</tr>
		<?php }?>
		
		
		
		
		<?php if(in_array('term', $writeColumn)){?>
		<tr>
			<th><label for="start_date">배너기간</label></th>
			<td class="tleft">
				<input type="text" id="start_date" name="start_date" value="<?php echo $dbData['start_date']?>" autocomplete="off" class="datepicker inputs w100" /> ~
				<input type="text" id="end_date" name="end_date" value="<?php echo $dbData['end_date']?>" autocomplete="off" class="datepicker inputs w100" />
			</td>
		</tr>
		<?php }?>
		
		<?php if(in_array('dday', $writeColumn)){?>
		<tr>
			<th><label for="start_date">D-day</label></th>
			<td class="tleft">
				<input type="text" id="start_date" name="start_date" value="<?php echo $dbData['start_date']?>" autocomplete="off" class="datepicker inputs w100" />
			</td>
		</tr>
		<?php }?>
		
		<?php if(in_array('link', $writeColumn)){?>
		<tr>
			<th><label for="link">배너 링크</label></th>
			<td class="tleft"><input type="text" id="link" name="link" value="<?php echo $dbData['link']?>" class="inputs wd90" /></td>
		</tr>
		<?php }?>
		
		<?php if(in_array('target', $writeColumn)){?>
		<tr>
			<th>배너 새창</th>
			<td class="tleft">
				<input type="radio" id="link_target_S" name="link_target" <?=ischecked("S", $dbData['link_target'])?> value="S" class="inputs"  />
				<label for="link_target_S">배너 현재창</label>
				<input type="radio" id="link_target_B" name="link_target" <?=ischecked("B", $dbData['link_target'])?> value="B" class="inputs" />
				<label for="link_target_B">배너 새창</label>
			</td>
			
		</tr>
		<?php }?>
		
		<?php if(in_array('stop', $writeColumn)){?>
		<tr>
			<th><label for="isstop">배너중지</label></th>
			<td class="tleft">
				<input type="checkbox" id="isstop" name="isstop" value="1" <?=ischecked(1, $dbData['isstop'])?> class="inputs" />
			</td>
		</tr>
		<?php }?>
		
		<?php if(in_array('image', $writeColumn)){?>
		<tr>
			<th><label for="bfile">배너이미지</label></th>
			<td colspan="3" class="tleft">
				<input type="file" id="bfile" name="bfile" />
				<?php 
					$imageSize = isset($bannerInfo['imageSize']) && $bannerInfo['imageSize'] != '' ? explode("*", $bannerInfo['imageSize']) : explode( "*", "150*150");
					$width = $imageSize[0];
					$height = $imageSize[1];
				?>
				<span><?=$width?> * <?=$height?> 사이즈로 올려주세요</span>
			</td>
		</tr>
		<?php if($imageData != null){
			$fileicon = getFileIcon($imageData[0]['file_ext']);
			$imageSize = isset($bannerInfo['imageSize']) && $bannerInfo['imageSize'] != '' ? explode("*", $bannerInfo['imageSize']) : explode( "*", "150*150");
			$width = $imageSize[0];
			$height = $imageSize[1];
		?>
		<tr>
			<th>등록된 이미지</th>
			<td colspan="3" class="tleft">
				<img src="../data/upload/<?=$imageData[0]['attach_file_name']?>" style="width:<?=$width?>px" alt="<?=$dbData[0]['subject']?> 섬네일 파일" />
				<a href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$imageData[0]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|type"))?>" class="in_btn btn_delete delete" title="<?=$imageData[0]['down_file_name']?> 파일 삭제">삭제</a>
			</td>
		</tr>
		<?php }?>
		<?php }?>
	</tbody>
</table>
	



