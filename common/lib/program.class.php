<?php 
class Program
{
	var $config_table = 'program_config'; 	//프로그램 설정 테이블
	var $list_table = 'program';			//프로그램 목록 테이블
	var $apply_table = 'program_apply';		//프로그램 신청목록 테이블
	
	public function __construct ()
	{
	}
	
	/**
	 * 설정정보를 가져옴
	 * @param number $menuID
	 */
	public function getConfig($menuID = 0){
		
		global $DB;
		
		$query = "SELECT * FROM ".$this->config_table." WHERE site_menuid = ".$menuID;
		$dbData = $DB->getDBData($query);
		
		$configData = array();
		if(count($dbData) > 0){
			$configData = $dbData[0];
		}else{
			$configData = null;
		}
		
		return $configData;
	}
	
	
	public function getSiteMenuOption($id, $depth, $siteName = null, $update_mode_second_id = null)
	{
		global $DB;
		$query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteName}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
		$dbData = $DB->getDBData($query);
		$total = count($dbData);
	
	
		if($total > 0)
		{
			for($i = 0; $i < count($dbData); $i++)
			{
				if($update_mode_second_id) $selected = isselected($update_mode_second_id, $dbData[$i]['menu_id']);
				else $selected = "";
	
				$id = $dbData[$i]['menu_id'];
				$depth = $dbData[$i]['rank'] + 1;
				echo "<option value=\"{$dbData[$i]['menu_id']}\" {$selected}>".str_repeat("&nbsp;&nbsp;&nbsp;", $depth - 1).$dbData[$i]['menu_title']."</option>";
	
				$this->getSiteMenuOption($id, $depth, $siteName, $update_mode_second_id);
			}
		}else
		{
	
		}
	}
	
	
	public function getUseColumn($config = null, $type = 'program'){
		
		$useData = array();
		if($type == 'program'){
            $field_name = explode("|", $config['program_field_name']);
            $field_use = explode("|", $config['program_field_use']);
		}else if($type == 'apply'){
            $field_name = explode("|", $config['apply_field_name']);
            $field_use = explode("|", $config['apply_field_use']);
        }
		
		if($config != null){
		    foreach($field_use as $key => $value){
		        if($value == 1){
    		        $useData['f'.($key + 1)] = $field_name[$key];
		        }
		    }
		}
		
		return $useData;
	}
	
	
	public function getProgramState($start_date, $end_date, $total_num, $current_num, $prefix = '교육')
	{
		$time = time();
	
		$numok = $total_num > $current_num ? true : false;
	
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
	
		if($start_date > $time && $end_date > $time)
			$term = "before";		//예정교육
		else if($start_date < $time && $end_date > $time)
			$term = "ing";			//진행교육
		else if($start_date < $time && $end_date < $time)
			$term = "after";		//지난교육
	
	
		$state = array(
				'edu' => "",
				'enroll' => "",
				'state' => $term
		);
	
		if($term == "before") //예정교육
		{
			$state['edu'] = "예정".$prefix;
			$state['enroll'] = "접수예정";

		}else if($term == "ing")  //진행교육
		{
			 
	    	if($numok)
	    	{
	    		$state['edu'] = "진행".$prefix;
	    		$state['enroll'] = "접수하기";
	    	}else
	    	{
	    		$state['edu'] = "마감".$prefix;
	    		$state['enroll'] = "접수마감";
	    		$state['state'] = "after";
	    	}


		}else if($term == "after") //지난교육
		{
			$state['edu'] = "지난".$prefix;
			$state['enroll'] = "접수마감";
		}


		return $state;
	}
	
	
	/**
	 * 설정값에서 예약 사용 여부를 가져옴.
	 * @param unknown $config
	 */
	public function reservUseCheck($config = null){
		
		$reserv = false;
		$reserv = isset($config['reserv_check']) && $config['reserv_check'] == 1 ? true : false;
		return $reserv;
	}
	
	
	public function getTotalNum($no = 0){
		
		global $DB;
		
		$total = 0;
		
		$query = "SELECT total FROM ".$this->list_table." WHERE indexcode = ".$no;
		$dbData = $DB->getDBData($query);
		
		$total = count($dbData) > 0 ? $dbData[0]['total'] : 0;
		
		return $total;
	}
	
	
	
	/**
	 * 현재 신청 인원을 구함
	 */
	public function getCurrentNum($config = null, $no = 0){
		
		
		$current = 0;

		if($no == 0) return 0;
		
		$row_check_type = isset($config['finish_check_type']) && $config['finish_check_type'] == 0 ? true : false;
		
		//신청건수
		if($row_check_type){
			
			$current = $this->getApplyRowNum($no);
			
		//참여인원 포함
		}else{
			$current = $this->getApplyEnterNum($no);
		}
		
		return $current;
	}
	
	
	/**
	 * 
	 * 프로그램의 신청 로우를 리턴
	 */
	public function getApplyRowNum($no = 0){
		global $DB;
		$num = 0;
		
		$query = "SELECT count(*) FROM ".$this->apply_table." WHERE programcode = ".$no;
		$dbData = $DB->getDBData($query);
			
		$num = count($dbData) > 0 ? intval($dbData[0][0]) : 0;
			
		return $num;
	}
	
	
	/**
	 * 프로그램의 신청 참여인원 수를 합산하여 리턴
	 * @param number $no
	 */
	public function getApplyEnterNum($no = 0){
		global $DB;
		$num = 0;
		
		$query = "SELECT sum(num1) FROM ".$this->apply_table." WHERE programcode = ".$no;
		$dbData = $DB->getDBData($query);
			
		$num = count($dbData) > 0 ? intval($dbData[0][0]) : 0;
			
		return $num;
	}
	
	
	/**
	 * 진행기간 표시방법
	 */
	public function getProgressDateText($data = null){
		
		$text = '';
		
		$ptype = intval($data['ptype']);
		$date1 = $data['date1'] != '' && $data['date1'] != "0000-00-00" ? $data['date1'] : "";
		$date2 = $data['date2'] != '' && $data['date2'] != "0000-00-00" ? $data['date2'] : "";
		$ptext = trim($data['ptext']);
		
		
		if($ptype == 0){
			
			$text = $date1 != '' ? $date1 : "";
			$text .= $date1 != '' || $date2 != '' ? " ~ " : "";		
			$text .= $date2 != '' ? $date2 : "";
			
		}else if($ptype == 1){
			$text = $ptext;
		}
		
		
		return $text;
		
	}
	
	public function setConfig($menu_id = 0){
	    global $DB, $userID, $userName;
	    
	    if(intval($menu_id) == 0) return ;
	    
	    $query = "SELECT count(*) FROM ".$this->config_table." WHERE site_menuid = ".$menu_id;
	    $dbData = $DB->getDBData($query);
	  
	    $row_count = intval($dbData[0][0]);
	  
	    if($row_count == 0){
	        $column = $DB->getColumns($this->config_table, array('indexcode'));
	        $column['writetime']['type'] = "now";
	        
	        $data = array();
	        $data['uid'] = $userID;
	        $data['uname'] = $userName;
	        $data['ip'] = $_SERVER['REMOTE_ADDR'];
	        $data['site_menuid'] = $menu_id;
	        $query = $DB->insertSql($column, $data, $this->config_table);
	        $DB->runQuery($query);
	    }
	    
	}
	
	public function deleteConfig($menu_id = 0){
	    global $DB;
	    
	    if(intval($menu_id) == 0) return ;
	    $query = "DELETE FROM ".$this->config_table." WHERE site_menuid = ".$menu_id;
	    $DB->runQuery($query);
	}
	
}
?>