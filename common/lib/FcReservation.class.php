<?php 
class FcReservation
{
	var $facilityTable = 'fcFacilityInfo';                 //예약시설 목록 테이블
	var $reservationTable = 'fcReservationInfo';           //예약시설 신청내역 테이블
	var $equipmentTable = 'fcEquipmentInfo';               //예약시설 대여장비 테이블
	var $dbInfo = null;
	var $weekdays = array('일', '월', '화', '수', '목', '금', '토');
	
	public function __construct (){
	    
	    global $DB;
	    $this->dbInfo = $DB;
	    
	}
	
	
	public function getWeekClass($w){
	    $class = "";
	    switch ($w) {
	        case 0:
	           $class = "sun";
	        break;
	        case 1:
	        case 2:
	        case 3:
	        case 4:
	        case 5:
	          $class = "normal"; 
	        break;
	        case 6:
	           $class = "sat";
	        default:
	            ;
	        break;
	    }
	    return $class;
	}
	
	
	/**
	 * 시설의 type이 list일 경우 목록을 array형태로 리턴, total 일경우 전체개수를 리턴
	 * @param string $type 타입
	 * @param number $pno 페이지번호
	 * @return unknown
	 */
	public function getFacilityList($type = 'total', $pno = 1){
	    
	    $data = array();
	    global $isAdmin;
	    $where = " WHERE delflag = 0";
	    
	    //관리자가 아니면 예약사용된 시설만 노출
	    if(!$isAdmin) $where .= " AND reservation_use = 1";
	    
	    if($type == 'list'){
	        
	        global $SKIN;
	        $orderby = " ORDER BY writetime DESC, indexcode DESC";
	        
	        if(!isset($SKIN->listLimitNum) || intval($SKIN->listLimitNum) == 0) $SKIN->listLimitNum = 10;
	        $limit_from = ($pno - 1) * $SKIN->listLimitNum;
	        if($limit_from < 0) $limit_from = 0;
	        $limit = " LIMIT ".$limit_from.", ".$SKIN->listLimitNum;
	        
	        $query = "SELECT * FROM ".$this->facilityTable.$where.$orderby.$limit;
	        $data = $this->dbInfo->getDBData($query);
	        return $data;
	    }else if($type == 'total'){
	        $query = "SELECT count(*) FROM ".$this->facilityTable.$where;
            $data = $this->dbInfo->getDBData($query);
            $total = $data[0][0];
            return $total;
	    }
        	    
	}
	
	
	/**
	 * 시설의 정보를 가져옴.
	 * @param number $no       시설코드
	 * @return unknown
	 */
	public function getFacilityDataOne($no = 0){
	    
	    $query = "SELECT * FROM ".$this->facilityTable." WHERE indexcode = ".$no;
	    $data = $this->dbInfo->getDBData($query);
	    return $data;
	}
	
	/**
	 * 시설의 특정 날짜의 예약자 목록을 가져옴.
	 * @param number $no       시설코드
	 * @param string $date     예약날짜
	 * @return NULL|unknown
	 */
	public function getSomedayReservationList($no = 0, $date = ''){
	    
	    if($no == 0 || $date == '') return null;
	    $query = "SELECT * FROM ".$this->reservationTable." WHERE facode = ".$no." AND reservation_date = '".$date."'";
	    $data = $this->dbInfo->getDBData($query);
	    return $data;
	}
	
	
	/**
	 * 캘린더 호출 함수
	 * 예약 방식에 따라 다른 함수 호출
	 * 
	 */
	public function getCalendar($no, $date = ''){
	    
	    $fcData = $this->getFacilityDataOne($no);
	    $type = $fcData[0]['reservation_type'];
	    
	    if($type == 0){
	        $this->getTimeReservationCalendar($no, $date);
	    }else if($type == 1){
	        $this->getDivisionReservationCalendar($no, $date);
	    }
	}
	
	
	/**
	 * 예약신청 페이지의 시간대별 예약 캘린더 생성
	 * @param number $no
	 * @param string $date
	 */
	public function getTimeReservationCalendar($no = 0, $date = ''){
	    
        //해당 시설의 예약 정보 가져오기
        $facilityData = $this->getFacilityDataOne($no);
        $reservation_use = $facilityData[0]['reservation_use'];
        
        if($reservation_use == 0){
            echo "<div class=\"no_reserv\">현재 시설은 예약 사용중이 아닙니다.</div>";
            return;
        }
	    
        if($date == '') $date = date("Y-m-d");
	    $date_time = strtotime($date);
        $w = date('w', $date_time);
        
        if($w){
            $start_date = date("Y-m-d", $date_time - 86400 * $w);
        } else {
           $start_date = $date; 
        }
        $end_date = date("Y-m-d", strtotime($start_date) + 86400 * 6);
        
        $prev_week = date("Y-m-d", strtotime($start_date." -1 week"));
        $next_week = date("Y-m-d", strtotime($start_date." +1 week"));
        
	   
        $calendar_start_time = strtotime($start_date);     //달력에서의 시작일
        $calendar_end_time = strtotime($end_date);     //달력에서의 마지막일
	   
	   
            
        $reservation_type1_time_unit = $facilityData[0]['reservation_type1_time_unit'];
       
        
        $time_list = $facilityData[0]['reservation_type1_reservation_time'] != "" ? explode("|", $facilityData[0]['reservation_type1_reservation_time']) : array();
        $max_count = intval($facilityData[0]['reservation_type1_max_count']) > 0 ? intval($facilityData[0]['reservation_type1_max_count']) : 1;
        ?>
    
        <div class="day-title">
    		<span class="day-prev"><a href="#" data-date="<?=$prev_week?>" data-no="<?=$no?>">◀</a></span>
    		<span><?=str_replace("-", ".", $start_date)?> ~ <?=str_replace("-", ".", $end_date)?></span>
    		<span class="day-next"><a href="#" data-date="<?=$next_week?>" data-no="<?=$no?>">▶</a></span>
    	</div>
		<div class="weekbox timebox">
        	
    		<?php  
    		for($t = $calendar_start_time; $t <= $calendar_end_time; $t = $t + 86400){
    		    $_day = date("Y-m-d", $t);  //날짜
    		    $_w = date("w", $t);        //요일 값
    		    
    		    
    		    $_title_class = $this->getWeekClass($_w);
    		    $_title_txt = $this->weekdays[$_w];
    		    
    		    
    		    //예약 가능 날짜 체크
    		    $_dateCheck = $this->reservationDateCheck($no, $_day);
    	    ?>
    		<div class="daybox">
    			<div class="day-mtitle">
    				<?=date("m", $t)?>월 <?=date("d", $t)?>일(<span class="<?=$_title_class?>"><?=$_title_txt?></span>)
    			</div>
    			<div class="dayboxw">
    				<?php
    				    $midnightTime = strtotime($_day);
    				    foreach($time_list as $value){
    				        
				        $time1 = $midnightTime + $value * 1800;
    				    
    				    if($reservation_type1_time_unit == '30M'){
        				    $time2 = $time1 + 1800;
    				    }else if($reservation_type1_time_unit == '1H'){
        				    $time2 = $time1 + 3600;
    				    }
    				    
    				    $_timeCheck = $this->reservationTimeCheck($no, $_day, $value);
    				    
    				    //예약 가능 날짜이면서 예약시작시간이 현재시간 이후만 예약 가능
    				    $_day_class = $_dateCheck && $_timeCheck  ? 'dayon' : '';
    			    ?>
    				<div class="day-time <?=$_day_class?>" data-date="<?=$_day?>" data-time="<?=substr($value, 0, 5)?>"><?=date("H:i", $time1)?>~<?=date("H:i", $time2)?></div>
    				<?php }?>
    			</div>
    		</div>
    		<?php }?>
		</div>
    		
		<input type="hidden" id="max_count" name="max_count" value="<?=$max_count?>" />
		<input type="hidden" id="date" name="date" value="" />
        <input type="hidden" id="stime" name="stime" value="" />
        <input type="hidden" id="etime" name="etime" value="" />
        <input type="hidden" id="time" name="time" value="" />
<?php 
	    
	    
	}
	
	
	/**
	 * 예약신청 페이지의 오전/오후/야간 예약 캘린더 생성
	 * @param number $no
	 * @param string $date
	 */
	public function getDivisionReservationCalendar($no = 0, $date = ''){
	    
	    //해당 시설의 예약 정보 가져오기
	    $facilityData = $this->getFacilityDataOne($no);
	    $reservation_use = $facilityData[0]['reservation_use'];
	    
	    if($reservation_use == 0){
	        echo "<div class=\"no_reserv\">현재 시설은 예약 사용중이 아닙니다.</div>";
	        return;
	    }
	    
	    
	    if($date == '') $date = date("Y-m-d");
	    $date_arr = explode("-", $date);
	    
	    $year = $date_arr[0];
	    $month = $date_arr[1];
	    $day = $date_arr[2];
	    
	    // 날짜 설정하기
	    $m_start_date = $year . "-" . $month . "-01"; // 월 시작일(매월 1일)
	    $days = date("t", strtotime($m_start_date)); // 총일수 구하기
	    $m_end_date = $year . "-" . $month . "-" . $days; // 월 마지막 일
	    
	    $m_start_date_weeknum = date("w", strtotime($m_start_date)); // 월 시작일 요일 값 구하기
	    $m_end_date_weeknum = date("w", strtotime($m_end_date)); // 월 마지막 날 요일 값 구하기
	    $start_date = date("Y-m-d", strtotime($m_start_date) - (60 * 60 * 24 * $m_start_date_weeknum)); // 달력 표시상의 첫날
	    $end_date = date("Y-m-d", strtotime($m_end_date) + (60 * 60 * 24 * (6 - $m_end_date_weeknum))); // 달력 표시상의 마지막 날
	    $total_week = ceil(($days + $m_start_date_weeknum) / 7);
	    
	    $pre_month = $month <= 1 ? ($year - 1) . "-12-01" : $year . "-" . str_pad(intval($month - 1), 2, "0", STR_PAD_LEFT) . "-01";
	    $next_month = $month >= 12 ? ($year + 1) . "-01-01" : $year . "-" . str_pad(intval($month + 1), 2, "0", STR_PAD_LEFT) . "-01";
	    
	    $calendar_start_time = strtotime($start_date);     //달력에서의 시작일
	    $calendar_end_time = strtotime($end_date);     //달력에서의 마지막일
	    $time_list = array();
	    
	   ?>
	   	<div class="day-title">
    		<span class="day-prev"><a href="#" data-date="<?=$pre_month?>" data-no="<?=$no?>">◀</a></span>
    		<span><?=$year?>.<?=$month?></span>
    		<span class="day-next"><a href="#" data-date="<?=$next_month?>" data-no="<?=$no?>">▶</a></span>
    	</div>
    	
		<div class="weekbox divisionbox">
    		<?php foreach($this->weekdays as $_w => $value){
    		  
    		    $_title_class = $this->getWeekClass($_w);
    		    $_title_txt = $this->weekdays[$_w];
    		    
    		    ?>
        	<div class="daybox titlebox">
    			<div class="day-mtitle">
    				(<span class="<?=$_title_class?>"><?=$_title_txt?></span>)
    			</div>
			</div>
			<?php }?>
    		<?php  
    		for($t = $calendar_start_time; $t <= $calendar_end_time; $t = $t + 86400){
    		    $_day = date("Y-m-d", $t);  //날짜
    		    
    		    //예약 가능 날짜 체크
    		    $_dateCheck = $this->reservationDateCheck($no, $_day);
    		    $_title_class = $this->getWeekClass(date("w", $t));
    	    ?>
			<div class="daybox">
				<div class="dayboxw">
					<div class="day-mtitle">
        			<?=date("m", $t)?>월 <?=date("d", $t)?>일 <span class="week <?=$_title_class?>">(<?=$this->weekdays[date("w", $t)]?>)</span>
        			</div>
    				<?php if($facilityData[0]['reservation_type2_morning_use']){    //오전
    				    $morning_time = explode("|", $facilityData[0]['reservation_type2_morning_time']);
    				    $min = min($morning_time);
    				    $max = max($morning_time);
    				    
    				    $time1 = date("H:i", strtotime($_day) + $min * 1800);
    				    $time2 = date("H:i", strtotime($_day) + $max * 1800 + 1800);
    				    
    				    
    				    for($i = $min; $i <= $max; $i++){
    				        $_timeCheck = $this->reservationTimeCheck($no, $_day, $i);
    				        if(!$_timeCheck) break;
    				    }
    				    $_day_class = $_dateCheck && $_timeCheck  ? 'dayon' : '';
				    ?>
    				<div class="day-time <?=$_day_class?>" data-type="time1" data-date="<?=$_day?>" data-time="<?=$facilityData[0]['reservation_type2_morning_time']?>">오전 (<?=$time1?> ~ <?=$time2?>)</div>
    				<?php }?>
    				
    				<?php if($facilityData[0]['reservation_type2_afternoon_use']){  //오후
    				    $afternoon_time = explode("|", $facilityData[0]['reservation_type2_afternoon_time']);
    				    $min = min($afternoon_time);
    				    $max = max($afternoon_time);
    				    
    				    $time1 = date("H:i", strtotime($_day) + $min * 1800);
    				    $time2 = date("H:i", strtotime($_day) + $max * 1800 + 1800);
    				    
    				    for($i = $min; $i <= $max; $i++){
    				        $_timeCheck = $this->reservationTimeCheck($no, $_day, $i);
    				        if(!$_timeCheck) break;
    				    }
    				    $_day_class = $_dateCheck && $_timeCheck  ? 'dayon' : '';
    				    
				    ?>
    				<div class="day-time <?=$_day_class?>" data-type="time2" data-date="<?=$_day?>" data-time="<?=$facilityData[0]['reservation_type2_afternoon_time']?>">오후 (<?=$time1?> ~ <?=$time2?>)</div>
    				<?php }?>
    				
    				<?php if($facilityData[0]['reservation_type2_night_use']){  //야간
    				    
        				$night_time = explode("|", $facilityData[0]['reservation_type2_night_time']);
        				$min = min($night_time);
        				$max = max($night_time);
        				
        				$time1 = date("H:i", strtotime($_day) + $min * 1800);
        				$time2 = date("H:i", strtotime($_day) + $max * 1800 + 1800);
        				
        				for($i = $min; $i <= $max; $i++){
        				    $_timeCheck = $this->reservationTimeCheck($no, $_day, $i);
        				    if(!$_timeCheck) break;
        				}
    				    $_day_class = $_dateCheck && $_timeCheck  ? 'dayon' : '';
    				    
				    ?>
    				<div class="day-time <?=$_day_class?>" data-type="time3" data-date="<?=$_day?>" data-time="<?=$facilityData[0]['reservation_type2_night_time']?>">야간 (<?=$time1?> ~ <?=$time2?>)</div>
    				<?php }?>
    			
				</div>
    		</div>
    		<?php }?>
		</div>
		<input type="hidden" id="date" name="date" value="" />
        <input type="hidden" id="time1" name="time1" value="" />
        <input type="hidden" id="time2" name="time2" value="" />
        <input type="hidden" id="time3" name="time3" value="" />
		
	   <?php 
	}
	
	
	
	/**
	 * 예약 신청정보 입력 페이지에서 예약 시간을 텍스트로 표시
	 * @param unknown $start 예약 시작 시간
	 * @param unknown $end 예약 종료 시간
	 * @param string $unit 시설에 설정된 예약 단위 ( 30M : 30분, 1H : 1시간)
	 * @return string 
	 */
	public function getDisplayTime($no = 0, $date, $time = '', $time2 = '', $time3 = ''){
	    
	    if(!$no) return null;
	    
	    $fcData = $this->getFacilityDataOne($no);
	    $reservation_type = $fcData[0]['reservation_type'];
	    $text = "";
	    if($reservation_type == 0){
	        $time = explode("|", $time);
   
	        $text = date("Y년 m월 d일 H:i", strtotime($date) + $time[0] * 1800);
	        
	        $unit = $fcData[0]['reservation_type1_time_unit'];
	        if($unit == '30M'){
	            $text .= " ~ ".date("H:i", strtotime($date) + $time[count($time) - 1] * 1800 + 1800);
	        }else if($unit == '1H'){
	            $text .= " ~ ".date("H:i", strtotime($date) + $time[count($time) - 1] * 1800 + 3600);
	        }
	        
	    }else if($reservation_type == 1){
	        
	        $date_txt = date("Y년 m월 d일", strtotime($date));
	        $division = array();
	        if($time){ 
	            array_push($division, '오전');
	        }
	        if($time2){
	            array_push($division, '오후');
	        }
	        if($time3){
	            array_push($division, '야간');
	        }
	        
	        $division_txt = implode("/", $division);
	        
	        $text = $date_txt." ".$division_txt;
	       
	    }
	    
	   
	   
	    return $text;
	}
	

	/**
	 * 시설의 예약 사용 여부를 리턴함.
	 * @param number $no
	 * @return boolean
	 */
	public function reservationUseCheck($no = 0){
	    
	    $check = false;
	    if($no > 0){
	        $fcData = $this->getFacilityDataOne($no);
	        $check = $fcData[0]['reservation_use'] ? true : false;
	    }
	    
	    return $check;
	}
	
	
	/**
	 * 시설의 예약 가능 날짜인지 체크
	 * @param number $no 시설코드값
	 * @param string $date 예약 날짜
	 * @return boolean
	 */
	public function reservationDateCheck($no = 0, $date = ''){
	    
	    $check = false;
	    
	    if($no > 0 && $date != ""){
	        
	        $w = date("w", strtotime($date));        //요일 값
	        
	        $fcData = $this->getFacilityDataOne($no);
	        
	        $reservation_start_date = $fcData[0]['reservation_start_date'];                   //예약 시작일
	        $reservation_end_date = $fcData[0]['reservation_end_date'];                       //예약 종료일
	        $weekday_out_array = explode("|", $fcData[0]['weekday_out']);                     //정기 휴일
	        $date_out_array = explode(",", $fcData[0]['date_out']);                           //제외 날짜
	        
	        
	        $flag1 = in_array($w, $weekday_out_array) ? 0 : 1;     //flag1는 휴무일에 포함되는지 여부 포함되면 0, 포함되지 않으면 1
	        $flag2 = in_array($date, $date_out_array) ? 0 : 1;      //flag2은 특정일 제외에 포함되는지 여부 포함되면 0, 포함되지 않으면 1
	        
	        //flag3은 선택한 날짜가 예약기간에 포함되는지 체크
	        if($reservation_start_date == '0000-00-00' || $reservation_start_date == '' || $reservation_end_date == '0000-00-00' || $reservation_end_date == ''){
	            $flag3 = 1;     //예약 날짜가 설정되어 있지 않으면 1
	        }else{ //예약 날짜가 설정되어 있으면
	            $flag3 = $date >= $reservation_start_date  && $date <= $reservation_end_date ? 1 : 0; // 기간내에 포함되면 1, 포함되지 않으면 0 
	        }
	        
	        //flag4는 예약 날짜가 오늘 이전 날짜인지 체크 이전 날짜이면 0, 오늘이거나 이후 날짜이면 1
	        $flag4 = strtotime(TIME_YMD) <= strtotime($date) ? 1 : 0;

	        $check = $flag1 && $flag2 && $flag3 && $flag4 ? true : false;
	    }
	    
	    return $check;
	}
	
	
	/**
	 * 예약 신청정보 입력 페이지 또는 폼 전송되는 페이지에서 해당 시설의 예약 가능 여부를 체크한다.
	 * 예약시간이 현재시간 이후인지, 해당 시설에 중복된 시간대에 예약이 있는지 등을 체크함.
	 * @param number $no 예약 시설 코드값
	 * @param number $starttime 예약 시작 시간값(timestamp 형식)
	 * @param number $endtime 예약 종료 시간(timestamp 형식)
	 */
	public function reservationTimeCheck($no = 0, $date = '', $seq = 0){
	    
	    $check = false;
	    
	    if($no && $date && $seq){
	    
	        
	        $fcData = $this->getFacilityDataOne($no);
	        
	        $time = strtotime($date) + $seq * 1800;
	        $flag1 = $time > SERVER_TIME ? true : false ;
	       
	        
	        $query = "SELECT count(*) FROM ".$this->reservationTable." WHERE 
            facode = ".$no."  AND 
            reservation_date = '$date' AND
            reservation_time_seq_list LIKE '%/$seq/%' 
            ";
	        $data = $this->dbInfo->getDBData($query);
	        $flag2 = intval($data[0][0]) > 0 ? false : true;
	        
	        $check = $flag1 && $flag2 ? true : false;
	        
	    }
	    return $check;
	    
	}
	
	
	/**
	 * 
	 * @param number $no
	 * @param string $time 예약시간값(시간대, 오전)
	 * @param string $time2 예약시간값(오후)
	 * @param string $time3 예약시간값(야간)
	 * @return number
	 */
	public function getReservationFee($no = 0, $time = '', $time2 = '', $time3 = ''){
	    
	    $fee = 0;
	    
	    if($no){
	        
	        $fcData = $this->getFacilityDataOne($no);
	        $reservation_type = $fcData[0]['reservation_type'];
	        

	        if($reservation_type == 0){ 	        //시간대별 예약일 경우 요금
	            
	            $timeList = explode("|", $time);
	            
	            $reservation_count = count($timeList);  //예약회수
	            $default_count = $fcData[0]['reservation_type1_default_count'];        //기본요금 적용되는 예약회수
	            $default_fee = $fcData[0]['reservation_type1_default_fee'];            //기본요금
	            $add_fee = $fcData[0]['reservation_type1_add_fee'];                    //추가요금
	            
	            if($reservation_count <= $default_count){    //예약회수가 기본 예약회수보다 작거나 같다면
	                $fee = $default_fee;
	            }else{                                     //기본 예약회수보다 많다면
	                $add_count = $reservation_count - $default_count;
	                $fee = $default_fee + $add_fee * $add_count;
	                
	            }
	            
	            
	        }else if($reservation_type == 1){ //오전/오후/야간 방식일 경우 요금
	            
	            $morning_use = $fcData[0]['reservation_type2_morning_use'];        //오전예약 사용여부
	            $morning_fee = $fcData[0]['reservation_type2_morning_fee'];        //오전 사용금액
	            $afternoon_use = $fcData[0]['reservation_type2_afternoon_use'];    //오후예약 사용여부
	            $afternoon_fee = $fcData[0]['reservation_type2_afternoon_fee'];    //오후 사용금액
	            $night_use = $fcData[0]['reservation_type2_night_use'];            //야간예약 사용여부
	            $night_fee = $fcData[0]['reservation_type2_night_fee'];            //야간 사용금액
	            
	            if($morning_use){
	                $fee += $morning_fee;
	            }
	            if($afternoon_use){
	                $fee += $afternoon_fee;
	            }
	            if($night_use){
	                $fee += $night_fee;
	            }
	            
	        }
	    }
	    
	    return $fee;
	    
	}
	
	/**
	  예약신청순번값이 시설에 설정된 예약신청순번값과 일치하는지 체크(url 조작 여부 등)
	 * @param unknown $no
	 * @param string $time
	 * @param string $time2
	 * @param string $time3
	 * @return boolean
	 */
	public function reservationDivisionCheck($no = 0, $time = '', $time2 = '', $time3 = ''){
	    $check = true;
	    if($no > 0){
	        $fcData = $this->getFacilityDataOne($no);
	        
	        $morning_use = $fcData[0]['reservation_type2_morning_use'];        //오전예약 사용여부
            if($morning_use){
                $morning_time = $fcData[0]['reservation_type2_morning_time'];   
                if($morning_time != $time && $time != "") return false;         //오전 예약 순번값과 신청한 순번값이 일치하지 않는 경우
            }else{                                                             
                if($time != "") return false;        //오전예약 사용하지 않는 시설인데 순번값이 있는 경우
	        }
	        
	        $afternoon_use = $fcData[0]['reservation_type2_afternoon_use'];        //오후예약 사용여부
            if($afternoon_use){
                $afternoon_time = $fcData[0]['reservation_type2_afternoon_time'];  
                if($afternoon_time != $time2 && $time2 != "") return false;          //오후 예약 순번값과 신청한 순번값이 일치하지 않는 경우
            }else{                                                             
                if($time2 != "") return false;        //오후예약 사용하지 않는 시설인데 순번값이 있는 경우
	        }
	       
	        $night_use = $fcData[0]['reservation_type2_night_use'];        //야간예약 사용여부
            if($night_use){
                $night_time = $fcData[0]['reservation_type2_night_time'];   
                if($night_time != $time3 && $time3 != "") return false;    //야간 예약 순번값과 신청한 순번값이 일치하지 않는 경우
            }else{                                                             
                if($time3 != "") return false;        //야간예약 사용하지 않는 시설인데 순번값이 있는 경우
	        }
	        
	    }else{
	        return false;
	    }
	    return $check;
	}
	
	
	
	
	/**
	 * 예약시설의 예약목록을 가져옴
	 * @param number $no
	 * @param string $type
	 * @param number $pno
	 * @return unknown
	 */
	public function getReservationList($no = 0, $type = 'total', $pno = 1){
	    
	    $data = array();
	    $where = " WHERE delflag = 0 AND facode = ".$no;
	    
	    if($type == 'list'){
	        
	        global $SKIN;
	        $orderby = " ORDER BY writetime DESC, indexcode DESC";
	        
	        if(!isset($SKIN->listLimitNum) || intval($SKIN->listLimitNum) == 0) $SKIN->listLimitNum = 10;
	        $limit_from = ($pno - 1) * $SKIN->listLimitNum;
	        if($limit_from < 0) $limit_from = 0;
	        $limit = " LIMIT ".$limit_from.", ".$SKIN->listLimitNum;
	        
	        $query = "SELECT * FROM ".$this->reservationTable.$where.$orderby.$limit;
	        $data = $this->dbInfo->getDBData($query);
	        return $data;
	    }else if($type == 'total'){
	        $query = "SELECT count(*) FROM ".$this->reservationTable.$where;
	        $data = $this->dbInfo->getDBData($query);
	        $total = $data[0][0];
	        return $total;
	    }
	    
	}
	
	
	/**
	 * 예약자 정보를 가져옴.
	 * @param number $no 시설코드
	 * @return unknown
	 */
	public function getReservationDataOne($no = 0){
	    
	    $query = "SELECT * FROM ".$this->reservationTable." WHERE indexcode = ".$no;
	    $data = $this->dbInfo->getDBData($query);
	    return $data;
	}
	
	/**
	 * 자기가 예약한 게시물인지 체크함.
	 * 로그인 사용자의 경우 게시물 uid값을 체크
	 * 비로그인 사용자의 경우 게시물 uname, upw 값을 체크
	 */
	public function myReservationCheck($no = 0){
	    global $userID;
	    
	    $check = false;
	    
	    if($no > 0){
	    
    	    $query = "SELECT uid, uname, upw FROM ".$this->reservationTable." WHERE indexcode = {$no}";
    	    $dbData = $this->dbInfo->getDBData($query);
    	    
    	    $dbuid = $dbData[0]['uid'];
    	    $dbuname = $dbData[0]['uname'];
    	    $dbupw = $dbData[0]['upw'];
    	    
    	    if($userID){    //로그인 사용자일 경우 글 작성 아이디를 체크한다.
    	        $check = $dbuid == $userID ? true : false;
    	    }else{          //비로그인 사용자일 경우 세션에 저장된 신청자명과 패스워드를 체크한다.
    	        
    	        $sess_uname = trim($_SESSION['reservation_uname']);
    	        $query = "SELECT password('".$_SESSION['reservation_upw']."')";
    	        $dbData = $this->dbInfo->getDBData($query);
    	        $sess_upw = $dbData[0][0];
    	        
    	        $check = $sess_uname == $dbuname && $sess_upw == $dbupw ? true : false;
    	        
    	    }
	    }
	    
	    return $check;
	}
	
}
?>