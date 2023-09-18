<table class="table_basic mt50 th-g">
	<caption>예약 설정(<?=$dbData['subject']?>)</caption>
	<colgroup>
    	<col width="10%" />
    	<col width="40%" />
    	<col width="10%" />
    	<col width="40%" />
	</colgroup>
	<tbody>
	
		<tr>
			<th>예약 사용여부</th>
			<td class="tleft" colspan="3">
				<input type="radio" id="reservation_use_Y" name="reservation_use" value="1" <?=ischecked(1 , $dbData['reservation_use'])?>  />
				<label for="reservation_use_Y">사용</label>
				<input type="radio" id="reservation_use_N" name="reservation_use" value="0" <?=ischecked(0 , $dbData['reservation_use'])?>  />
				<label for="reservation_use_N">사용안함</label>
			</td>
		</tr>
		<tr class="reserv_use">
			<th><label for="reservation_start_date">예약 기간</label></th>
			<td class="tleft" colspan="3">
				<input type="text" name="reservation_start_date" id="reservation_start_date" value="<?php echo $dbData['reservation_start_date'] != "0000-00-00" ? $dbData['reservation_start_date'] : ""?>" class="inputs w100 datepicker" placeholder="ex) 2021-01-01" /> ~
				<input type="text" name="reservation_end_date" id="reservation_end_date" value="<?php echo $dbData['reservation_end_date'] != "0000-00-00" ? $dbData['reservation_end_date'] : ""?>" class="inputs w100 datepicker" placeholder="ex) 2021-01-31" />
				 
				<span class="pd5 ml10">
					<input type="checkbox" name="all_day_reservation" id="all_day_reservation" value="1" />
					<label for="all_day_reservation">모든기간사용 (체크하면 예약기간이 초기화되며 모든기간 예약이 가능합니다.)</label>
				</span>
			</td>
		</tr>
	
		<tr class="reserv_use">
			<th>정기휴일</th>
			<td class="tleft" colspan="3">
				<p class="mb10">예약을 받지 않을 요일에 체크해 주세요.</p>
				<?php 
				$weekday_out = $dbData['weekday_out'] != "" ? explode("|", $dbData['weekday_out']) : array();
				foreach($RESERVATION->weekdays as $key => $value){
			    ?>
			    <span class="mr10">
    				<input type="checkbox" id="weekday_<?=$key?>" name="weekday_out[]" value="<?=$key?>" <?=in_array($key , $weekday_out) ? "checked=\"checked\"" : ""?>  />
    				<label for="weekday_<?=$key?>"><?=$value?></label>
			    </span>
				<?php }?>
			</td>
		</tr>
		
		<tr class="reserv_use">
			<th><label for="date_out">특정일제외</label></th>
			<td class="tleft" colspan="3">
				<p class="mb10">예약을 받지 않을 특정 날짜를 콤마(,) 로 구분하여 입력해 주세요.</p>
				<textarea name="date_out" id="date_out" cols="30" rows="10" class="inputs wd90" style="height:80px" placeholder="<?=date("Y")?>-03-01,<?=date("Y")?>-05-05,<?=date("Y")?>-08-15"><?=$dbData['date_out']?></textarea>
			</td>
		</tr>
		
		<tr class="reserv_use">
    		<th>예약시간대 방식</th>
    		<td class="tleft" colspan="3">
    			<input type="radio" name="reservation_type" id="reservation_type1" value="0" <?=ischecked(0, $dbData['reservation_type'])?> <?=$dbData['reservation_type'] == '' ? "checked=\"checked\"" : "" ?> />
    			<label for="reservation_type1">시간대별 예약방식</label>
    			<input type="radio" name="reservation_type" id="reservation_type2" value="1" <?=ischecked(1, $dbData['reservation_type'])?> />
    			<label for="reservation_type2">오전/오후/야간별 예약방식</label>
    		</td>
		</tr>
		<tr class="reserv_use time_reserv">
			<th>예약시간단위</th>
    		<td class="tleft" colspan="3">
    			<input type="radio" name="reservation_type1_time_unit" id="time_unit_M" value="30M" <?=ischecked("30M", $dbData['reservation_type1_time_unit'])?> />
    			<label for="time_unit_M">30분 단위</label>
    			<input type="radio" name="reservation_type1_time_unit" id="time_unit_H" value="1H" <?=ischecked("1H", $dbData['reservation_type1_time_unit'])?> <?=$dbData['reservation_type1_time_unit'] == '' ? "checked=\"checked\"" : "" ?> />
    			<label for="time_unit_H">시간 단위</label>
    		</td>
		</tr>
		<tr class="reserv_use time_reserv time_m">
			<th>예약시간(30분 단위)</th>
    		<td class="tleft reservation_times" colspan="3">
    			<p class="mb10">예약을 받을 시간에 체크해 주세요. 체크하지 않은 시간은 예약이 되지 않습니다.</p>
        		<?php 
        		$reservation_type1_reservation_time = $dbData['reservation_type1_reservation_time'] != "" ? explode("|", $dbData['reservation_type1_reservation_time']) : array();
        		$start = strtotime('today');  //오늘 자정
        		$end = $start + 86400;        //내일 자정
        		$c = 0;
        		for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        		    $time1 = date("H:i", $i);
        		    $time2 = date("H:i", $i + 1800);
    		    ?>
    				<label for="reservation_time_m_<?=$c?>">
    					<input type="checkbox" id="reservation_time_m_<?=$c?>" name="reservation_type1_reservation_time_m[]" <?=in_array($c , $reservation_type1_reservation_time) ? "checked=\"checked\"" : ""?> value="<?=$c?>" /><?=$time1?> ~ <?=$time2?>
    				</label>    		
        		<?php
        		
        		  $c++;
        		}
        		?>
    		</td>
		</tr>
		<tr class="reserv_use time_reserv time_h">
			<th>예약시간(시간 단위)</th>
    		<td class="tleft reservation_times" colspan="3">
    			<p class="mb10">예약을 받을 시간에 체크해 주세요. 체크하지 않은 시간은 예약이 되지 않습니다.</p>
        		<?php 
        		$start = strtotime('today');  //오늘 자정
        		$end = $start + 86400;        //내일 자정
        		$c = 0;
        		for($i = $start; $i < $end; $i = $i + 3600){  //1시간 단위로 반복
        		    $time1 = date("H:i", $i);
        		    $time2 = date("H:i", $i + 3600);
    		    ?>
    				<label for="reservation_time_h_<?=$c?>">
    					<input type="checkbox" id="reservation_time_h_<?=$c?>" name="reservation_type1_reservation_time_h[]" <?=in_array($c , $reservation_type1_reservation_time) ? "checked=\"checked\"" : ""?> value="<?=$c?>" /><?=$time1?> ~ <?=$time2?>
    				</label>    		
        		<?php 
        		  $c = $c + 2;
        		}
        		?>
    		</td>
		</tr>
		<tr class="reserv_use time_reserv">
			
			<th><label for="reservation_type1_default_count">기본요금</label></th>
    		<td class="tleft">
    			<p class="mb10">기본요금을 입력해주세요.</p>
    			예약 회수 <input type="text" id="reservation_type1_default_count" name="reservation_type1_default_count" value="<?=$dbData['reservation_type1_default_count']?>" class="inputs w100" />회 까지 기본요금
        		<input type="text" id="reservation_type1_default_fee" name="reservation_type1_default_fee" value="<?=$dbData['reservation_type1_default_fee']?>" class="inputs" placeholder="ex) 10000" />원 적용
    		</td>
    		<th><label for="reservation_type1_add_fee">추가요금</label></th>
    		<td class="tleft">
    			<p class="mb10">기본예약 회수 초과시 추가적으로 횟수당 발생요금을 입력해주세요.</p>	
    			<input type="text" id="reservation_type1_add_fee" name="reservation_type1_add_fee" value="<?=$dbData['reservation_type1_add_fee']?>" class="inputs" placeholder="ex) 10000" />원
    		</td>
		</tr>
		
		<tr class="reserv_use time_reserv">
			<th><label for="reservation_type1_max_count">1일 최대 예약가능 횟수</label></th>
    		<td class="tleft" colspan="3">
    			<p class="mb10">개인당 1일 최대로 예약 가능한 횟수를 지정해주세요.</p>
        		<select name="reservation_type1_max_count" id="reservation_type1_max_count" class="inputs">
        			<?php for($i = 1; $i <= 48; $i++){?>
        			<option value="<?=$i?>" <?=isselected($i, $dbData['reservation_type1_max_count'])?>><?=$i?></option>
        			<?php }?>
        		</select>회
    		</td>
    		
		</tr>
		
		<tr class="reserv_use division_reserv">
			<th><label for="reservation_type2_morning_start">오전 예약시간</label></th>
    		<td class="tleft">
    			<?php 
    			$morning_time = explode("|", $dbData['reservation_type2_morning_time']);
    			$min = min($morning_time);
    			$max = max($morning_time);
    			?>
        		<select name="reservation_type2_morning_start" id="reservation_type2_morning_start" class="inputs">
        			<?php 
        			$start = strtotime('today');  //오늘 자정
        			$end = $start + 86400;        //내일 자정
        			$c = 0;
        			for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        			    $time = date("H:i", $i);
        			    ?>
        			    <option value="<?=$c?>" <?=isselected($c, $min)?>><?=$time?></option>
        			    <?php 
        			    $c++;
        			}
        			?>
        		</select> ~ 
        		<select name="reservation_type2_morning_end" id="reservation_type2_morning_end" class="inputs">
        			<?php 
        			$start = strtotime('today');  //오늘 자정
        			$end = $start + 86400;        //내일 자정
        			$c = 0;
        			for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        			    $time = date("H:i", $i + 1800); //끝나는 시간은 30분 후로 표시
        			    ?>
        			    <option value="<?=$c?>" <?=isselected($c, $max)?>><?=$time?></option>
        			    <?php 
        			    $c++;
        			}
        			?>
        		</select>
        		<input type="checkbox" name="reservation_type2_morning_use" id="reservation_type2_morning_use" value="1" <?=ischecked("1", $dbData['reservation_type2_morning_use'])?>/>
        		<label for="reservation_type2_morning_use">사용</label>
    		</td>
    		<th><label for="reservation_type2_morning_fee">오전 이용요금</label></th>
    		<td class="tleft">
    			<input type="text" name="reservation_type2_morning_fee" id="reservation_type2_morning_fee" value="<?php echo $dbData['reservation_type2_morning_fee']?>" class="inputs w100" placeholder="ex) 10000" />원
    		</td>
		</tr>
		<tr class="reserv_use division_reserv">
			<th><label for="reservation_type2_afternoon_start">오후 예약시간</label></th>
    		<td class="tleft">
    			<?php 
    			$afternoon_time = explode("|", $dbData['reservation_type2_afternoon_time']);
    			$min = min($afternoon_time);
    			$max = max($afternoon_time);
    			?>
        		<select name="reservation_type2_afternoon_start" id="reservation_type2_afternoon_start" class="inputs">
        			<?php 
        			$start = strtotime('today');  //오늘 자정
        			$end = $start + 86400;        //내일 자정
        			$c = 0;
        			for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        			    $time = date("H:i", $i);
        			    ?>
        			    <option value="<?=$c?>" <?=isselected($c, $min)?>><?=$time?></option>
        			    <?php 
        			    $c++;
        			}
        			?>
        		</select> ~ 
        		<select name="reservation_type2_afternoon_end" id="reservation_type2_afternoon_end" class="inputs">
        			<?php 
        			$start = strtotime('today');  //오늘 자정
        			$end = $start + 86400;        //내일 자정
        			$c = 0;
        			for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        			    $time = date("H:i", $i + 1800); //끝나는 시간은 30분 후로 표시
        			    ?>
        			    <option value="<?=$c?>" <?=isselected($c, $max)?>><?=$time?></option>
        			    <?php 
        			    $c++;
        			}
        			?>
        		</select>
        		<input type="checkbox" name="reservation_type2_afternoon_use" id="reservation_type2_afternoon_use" value="1" <?=ischecked("1", $dbData['reservation_type2_afternoon_use'])?>/>
        		<label for="reservation_type2_afternoon_use">사용</label>
    		</td>
    		<th><label for="reservation_type2_afternoon_fee">오후 이용요금</label></th>
    		<td class="tleft">
    			<input type="text" name="reservation_type2_afternoon_fee" id="reservation_type2_afternoon_fee" value="<?php echo $dbData['reservation_type2_afternoon_fee']?>" class="inputs w100" placeholder="ex) 10000" />원
    		</td>
		</tr>
		<tr class="reserv_use division_reserv">
			<th><label for="reservation_type2_night_start">야간 예약시간</label></th>
    		<td class="tleft">
    			<?php 
    			$night_time = explode("|", $dbData['reservation_type2_night_time']);
    			$min = min($night_time);
    			$max = max($night_time);
    			?>
        		<select name="reservation_type2_night_start" id="reservation_type2_night_start" class="inputs">
        			<?php 
        			$start = strtotime('today');  //오늘 자정
        			$end = $start + 86400;        //내일 자정
        			$c = 0;
        			for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        			    $time = date("H:i", $i);
        			    ?>
        			    <option value="<?=$c?>" <?=isselected($c, $min)?>><?=$time?></option>
        			    <?php 
        			    $c++;
        			}
        			?>
        		</select> ~ 
        		<select name="reservation_type2_night_end" id="reservation_type2_night_end" class="inputs">
        			<?php 
        			$start = strtotime('today');  //오늘 자정
        			$end = $start + 86400;        //내일 자정
        			$c = 0;
        			for($i = $start; $i < $end; $i = $i + 1800){  //30분 단위로 반복
        			    $time = date("H:i", $i + 1800); //끝나는 시간은 30분 후로 표시
        			    ?>
        			    <option value="<?=$c?>" <?=isselected($c, $max)?>><?=$time?></option>
        			    <?php 
        			    $c++;
        			}
        			?>
        		</select>
        		<input type="checkbox" name="reservation_type2_night_use" id="reservation_type2_night_use" value="1" <?=ischecked("1", $dbData['reservation_type2_night_use'])?>/>
        		<label for="reservation_type2_night_use">사용</label>
    		</td>
    		<th><label for="reservation_type2_night_fee">야간 이용요금</label></th>
    		<td class="tleft">
    			<input type="text" name="reservation_type2_night_fee" id="reservation_type2_night_fee" value="<?php echo $dbData['reservation_type2_night_fee']?>" class="inputs w100" placeholder="ex) 10000" />원
    		</td>
		</tr>
		
	</tbody>
</table>