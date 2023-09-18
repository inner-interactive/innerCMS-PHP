<?php
$dbData = $system['data']['config'];
include "menu.inc.php";

?>

<form action="<?php echo SKIN_URL?>setting.php" class="editor_form" method="post">
		
	<table class="table_basic mt50 th-g">
		<caption>프로그램 환경설정 (<?=$system['data']['menu_title']?>)</caption>
		<colgroup>
		<col width="10%" />
		<col width="40%" />
		<col width="10%" />
		<col width="40%" />
		</colgroup>
		<tbody>
			<tr>
				<th>신청접수 사용</th>
				<td class="tleft">
					<input type="radio" id="reserv_check1" name="reserv_check" <?=ischecked(1, $dbData['reserv_check'])?> value="1" />
					<label for="reserv_check1">사용</label>
					<input type="radio" id="reserv_check2" name="reserv_check" <?=ischecked(0, $dbData['reserv_check'])?> value="0" />
					<label for="reserv_check2">미사용</label>
				</td>
				<th>마감인원산정방식</th>
				<td class="tleft">
					<input type="radio" id="finish_check_type1" name="finish_check_type" <?=ischecked(0, $dbData['finish_check_type'])?> value="0" />
					<label for="finish_check_type1">신청건수</label>
					<input type="radio" id="finish_check_type2" name="finish_check_type" <?=ischecked(1, $dbData['finish_check_type'])?> value="1" />
					<label for="finish_check_type2">참여인원 포함</label>
					
				</td>
			</tr>
			
			<tr>
				<th>프로그램 소개내용</th>
				<td colspan="3" style="padding:10px">
					<?php echo editor_html("memo", $dbData['memo']);?>
				</td>
			</tr>
			
		
		</tbody>
	</table>
		
	<table class="table_basic mt50 th-g">
		<caption>프로그램 항목설정</caption>
		<colgroup>
		<col width="10%" />
		<col width="40%" />
		<col width="10%" />
		<col width="40%" />
		</colgroup>
		<tbody>
		<?php 
		$program_field_names = $dbData['program_field_name'] != "" ? explode("|", $dbData['program_field_name']) : null;
		$program_field_uses = $dbData['program_field_use'] != "" ? explode("|", $dbData['program_field_use']) : null;
		
		for($i = 0; $i < 10; $i++){?>
			<?php if( $i % 2 == 0){?><tr><?php }?>
				<th><label for="pg_f<?=$i?>">항목명<?=$i+1?></label></th>
				<td class="tleft">
					<input type="text" id="pg_f<?=$i?>" name="program_field_name[]" value="<?=$program_field_names[$i]?>" placeholder="ex) 수강료, 문의처, 교육시간 등" class="inputs wd50" />
					<input type="radio" id="pg_use<?=$i?>_1" name="program_field_use[<?=$i?>]" <?=ischecked(1, $program_field_uses[$i])?> value="1" />
					<label for="pg_use<?=$i?>_1">사용</label>
					<input type="radio" id="pg_use<?=$i?>_2" name="program_field_use[<?=$i?>]" <?=ischecked(0, $program_field_uses[$i])?> value="0" />
					<label for="pg_use<?=$i?>_2">미사용</label>
				</td>
			<?php if( $i % 2 == 1){?></tr><?php }?>
			<?php }?>
			
		</tbody>
	</table>
		
	<table class="table_basic mt50 th-g">
		<caption>신청페이지 항목설정</caption>
		<colgroup>
		<col width="10%" />
		<col width="40%" />
		<col width="10%" />
		<col width="40%" />
		</colgroup>
		<tbody>
		<?php 
		$apply_field_names = $dbData['apply_field_name'] != "" ? explode("|", $dbData['apply_field_name']) : null;
		$apply_field_uses = $dbData['apply_field_use'] != "" ? explode("|", $dbData['apply_field_use']) : null;
		
		for($i = 0; $i < 10; $i++){?>
			<?php if( $i % 2 == 0){?><tr><?php }?>
				<th><label for="ap_f<?=$i?>">항목명<?=$i+1?></label></th>
				<td class="tleft">
					<input type="text" id="ap_f<?=$i?>" name="apply_field_name[]" value="<?=$apply_field_names[$i]?>" placeholder="ex) 성별, 직책, 참여날짜  등" class="inputs wd50" />
					<input type="radio" id="ap_use<?=$i?>_1" name="apply_field_use[<?=$i?>]" <?=ischecked(1, $apply_field_uses[$i])?> value="1" />
					<label for="ap_use<?=$i?>_1">사용</label>
					<input type="radio" id="ap_use<?=$i?>_2" name="apply_field_use[<?=$i?>]" <?=ischecked(0, $apply_field_uses[$i])?> value="0" />
					<label for="ap_use<?=$i?>_2">미사용</label>
				</td>
			<?php if( $i % 2 == 1){?></tr><?php }?>
			<?php }?>
			
		</tbody>
	</table>
		
		
		
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="site_menuid" value="<?php echo $sno?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|sno', 1)?>" />
		<a href="<?php echo getBackUrl('menu|site|pagetype')?>&mode=list" class="btn btn-default">뒤로</a>
	</div>
</form>



<script type="text/javascript">
$('.editor_form').submit(function(){
	<?php 
		echo get_editor_js('memo');
	?>
});
</script>
