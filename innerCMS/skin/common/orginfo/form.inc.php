<?php
$dbData = $system['data']['dbData'];
?>
<table class="table_basic">
	<caption>팝업 내용 작성</caption>
	<colgroup>
		<col width="10%"/>
		<col width="40%"/>
		<col width="10%"/>
		<col width="40%"/>
	</colgroup>
	<tbody>
		<tr>
			<th><label for="subject">팝업 제목</label></th>
			<td colspan="3" class="tleft"><input type="text" id="subject" name="subject" value="<?php echo $dbData['subject']?>" class="inputs wd90" /></td>
		</tr>
		<tr>
			<th><label for="site">사이트 선택</label></th>
			<td class="tleft">
				<select name="site" id="site">
				<?php 
				foreach($system['siteList'] as $key => $value){
				?>
				<option value="<?php echo $key?>" <?php echo isselected($value, $dbData['site'])?>><?php echo $value['author']?></option>
				<?php }?>
				</select>
			</td>
			<th><label for="start_date">팝업기간</label></th>
			<td class="tleft">
				<input type="text" id="start_date" name="start_date" value="<?php echo $dbData['start_date']?>" autocomplete="off" class="datepicker inputs w100" /> ~
				<input type="text" id="end_date" name="end_date" value="<?php echo $dbData['end_date']?>" autocomplete="off" class="datepicker inputs w100" />
			</td>
		</tr>
		
		<tr>
			<th>창사이즈</th>
			<td class="tleft">
				<label for="width">가로폭</label>
				<input type="text" id="width" name="width" value="<?php echo $dbData['width']?>" class="inputs w100" />px
				<label for="height">세로폭</label>
				<input type="text" id="height" name="height" value="<?php echo $dbData['height']?>" class="inputs w100" />px
			</td>
			<th>창위치</th>
			<td class="tleft">
				<label for="left">좌측에서</label>
				<input type="text" id="left" name="left" value="<?php echo $dbData['left']?>" class="inputs w100" />px
				<label for="top">상단에서</label>
				<input type="text" id="top" name="top" value="<?php echo $dbData['top']?>" class="inputs w100" />px
			</td>
		</tr>
		<tr>
			<th><label for="pop_type">팝업 방식</label></th>
			<td class="tleft">
				<select name="pop_type" id="pop_type">
					<option value="popup" <?=isselected("popup", $dbData['pop_type'])?>>팝업창</option>
					<option value="layer" <?=isselected("layer", $dbData['pop_type'])?>>레이어</option>
				</select>
			</td>
			<th>팝업 옵션</th>
			<td class="tleft">
				<input type="checkbox" id="not_today" name="not_today" value="1" <?php if($mode == "write"){?> checked="checked"<?php }?> <?=ischecked(1, $dbData['not_today'])?> class="inputs" />
				<label for="not_today">오늘은 이창을 다시 열지 않음</label>
				<input type="checkbox" id="isstop" name="isstop" value="1" <?=ischecked(1, $dbData['isstop'])?> class="inputs" />
				<label for="isstop">팝업중지</label>
			</td>
		</tr>
		
		<tr>
			<th><label for="memo">팝업내용</label></th>
			<td colspan="3" class="tleft">
			<?php echo editor_html("memo", $dbData['memo']);?>
			</td>
		</tr>
		
	</tbody>
</table>
	



<script type="text/javascript">
$('.editor_form').submit(function(){
	<?php 
		echo get_editor_js('memo');
	?>
});
</script>
