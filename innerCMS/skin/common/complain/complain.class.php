<?php 
class Complain extends Menu {
	
	function __construct(){
		 
		$this->db = new DB();
	
	}
	
	/**
	 * 해당 메뉴의 전체 의견 수 구하기
	 * @param number $no
	 */
	private function getTotalComplain($no = 0){
		$query = "SELECT count(*) FROM ".COMPLAIN_TABLE." WHERE menu_id = $no";
		$dbData = $this->db->getDBData($query);
		return intval($dbData[0][0]);
	}
	
	/**
	 * 해당 메뉴의 오늘 의견 수 구하기
	 */
	private function getTodayComplain($no = 0){
		$query = "SELECT count(*) FROM ".COMPLAIN_TABLE." WHERE menu_id = $no AND writetime >= '".TIME_YMD." 00:00:00' AND writetime <= '".TIME_YMD." 23:59:59'";
		$dbData = $this->db->getDBData($query);
		return intval($dbData[0][0]);
	}
	
	/**
	 * 해당 메뉴의 평가 점수 구하기
	 */
	private function getAveragePoint($no = 0){
		
		$query = "SELECT SUM(point), count(*) FROM ".COMPLAIN_TABLE." WHERE menu_id = ".$no;
		$dbData = $this->db->getDBData($query);
		
		$sum = intval($dbData[0][0]);
		$total = intval($dbData[0][1]);
		$average = "";
		
		if($sum && $total){	//division by zero error 방지
			$average = sprintf('%.1f', $sum / $total);
		}
		
		return $average;
	}
	
	/**
	 * 메뉴순 정렬 리스트
	 * @param number $id
	 * @param number $depth
	 */
	public function getMenuOrderList($id = 0, $depth = 1){
		
		global $siteKey ;
		 
		$query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteKey}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
		$dbData = $this->db->getDBData($query);
		$total = count($dbData);
		if($total > 0){
		
			foreach($dbData as $value){
				
				$id = $value['menu_id'];
				$depth = $value['rank'] + 1;
				
				//전체 의견수 구하기
				$total_complain = $this->getTotalComplain($id);
			
				//오늘 의견수 구하기
				$today_complain = $this->getTodayComplain($id);
				
				//평가점수 구하기
				$average_point = $this->getAveragePoint($id);
				
			
				echo "<tr class=\"depth{$value['rank']}\">".PHP_EOL;
				echo  "<td>".$total_complain."</td>".PHP_EOL;
				echo  "<td>".$today_complain."</td>".PHP_EOL;
				echo  "<td>".$average_point."</td>".PHP_EOL;
				echo  "<td class=\"tleft menu_title\">";
				if($value['rank'] != 1) echo  "<img src=\"".SKIN_URL."img/icon_catlevel.gif\" />&nbsp;";
				echo  "<a href=\"".getBackUrl("menu|site|order")."&mode=view&no={$id}\">".$value['menu_title']."</a>";
				echo  "</td>".PHP_EOL;
				echo  "</tr>".PHP_EOL;
				
				$this->getMenuOrderList($id, $depth);
			}
			
		}
		
	}
	
	
	/**
	 * 전체 의견순 정렬 리스트 
	 */
	public function getTotalOrderList(){
		global $siteKey;
		
		$query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteKey}'ORDER BY menu_id ASC";
		$dbData = $this->db->getDBData($query);
		
		$data = array();
		foreach($dbData as $value){
			//전체 의견수 구하기
			$data[$value['menu_id']] = $this->getTotalComplain($value['menu_id']);
		}
		
		arsort($data);
		foreach($data as $no => $total){

			//메뉴명 구하기
			$positionArr = Menu::getPositionArray($no);
			$menu_title = Menu::makePositionHtml($positionArr, true);
			
			//오늘 의견수 구하기
			$today_complain = $this->getTodayComplain($no);

			//평가점수 구하기
			$average = $this->getAveragePoint($no);
		
			echo"<tr>".PHP_EOL;
			echo "<td>".$total."</td>".PHP_EOL;
			echo "<td>".$today_complain."</td>".PHP_EOL;
			echo "<td>".$average."</td>".PHP_EOL;
			echo "<td class=\"tleft\">";
			echo "<a href=\"".getBackUrl("menu|site|order")."&mode=view&no={$no}\">".$menu_title."</a>";
			echo "</td>".PHP_EOL;
			echo "</tr>".PHP_EOL;
		}
		
	}
	
	/**
	 * 오늘 의견순 정렬 리스트
	 */
	public function getTodayOrderList(){
		global $siteKey;
		
		$query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteKey}'ORDER BY menu_id ASC";
		$dbData = $this->db->getDBData($query);
		
		$data = array();
		foreach($dbData as $value){
			//오늘 의견수 구하기
			$data[$value['menu_id']] = $this->getTodayComplain($value['menu_id']);
		
		}
		
		arsort($data);
		foreach($data as $no => $today){
		
			//메뉴명 구하기
			$positionArr = Menu::getPositionArray($no);
			$menu_title = Menu::makePositionHtml($positionArr, true);
				
			//전체 의견수 구하기
			$total_complain = $this->getTotalComplain($no);
		
			//평가점수 구하기
			$average = $this->getAveragePoint($no);
		
			echo"<tr>".PHP_EOL;
			echo "<td>".$total_complain."</td>".PHP_EOL;
			echo "<td>".$today."</td>".PHP_EOL;
			echo "<td>".$average."</td>".PHP_EOL;
			echo "<td class=\"tleft\">";
			echo "<a href=\"".getBackUrl("menu|site|order")."&mode=view&no={$no}\">".$menu_title."</a>";
			echo "</td>".PHP_EOL;
			echo "</tr>".PHP_EOL;
		}
		
	}
	
	
	
	public function getComplainTotal($no = 0){
	    
	    if($no != 0){
	       $where = " WHERE menu_id = ".$no;   
	    }else{
	        $where = "";
	    }
	    $query = "SELECT count(*) FROM ".COMPLAIN_TABLE.$where." ORDER BY writetime DESC";
	    $dbData = $this->db->getDBData($query);
	    return intval($dbData[0][0]);
	}
	
	/**
	 * 뷰페이지의 만족도평가 상세내역을 구한다.
	 * @param number $no
	 * @return NULL[]|unknown[]
	 */
	public function getComplainInfo($no = 0, $pno = 1){
	    global $SKIN;
	    
	    if($no != 0){
	        $where = " WHERE menu_id = ".$no;
	    }else{
	        $where = "";
	    }
	    
	    $limit_num = $SKIN->listLimitNum;
	    $limit_from = ($pno - 1) * $limit_num;
	    if($limit_from < 0) $limit_from = 0;
	    
	    $limit = " limit ".$limit_from.", ".$limit_num;
	    
	    
		$data = array(
				'menu_title' => '',		//메뉴명
				'total' => 0,			//평가의견수
				'average' => '',		//평균점수
				'data' => array()		//의견 데이터
		);
		
		//메뉴명 구하기
		$positionArr = Menu::getPositionArray($no);
		$data['menu_title'] = Menu::makePositionHtml($positionArr, true);
		
		//평가의견수 구하기
		$data['total'] = $this->getTotalComplain($no);
		
		//평균점수 구하기
		$data['average'] = $this->getAveragePoint($no);
		
		
		
		//의견데이터 구하기
		$query = "SELECT * FROM ".COMPLAIN_TABLE.$where." ORDER BY writetime DESC".$limit;
		$dbData = $this->db->getDBData($query);
		$data['data'] = $dbData;
		return $data;
	}
	
	
	public function getComplainList($pno = 1){
	    global $SKIN;
	    
	
	    $limit_num = $SKIN->listLimitNum;
	    $limit_from = ($pno - 1) * $limit_num;
	    if($limit_from < 0) $limit_from = 0;
	    
	    $limit = " limit ".$limit_from.", ".$limit_num;
	    
	    
	    $data = array(
	        'menu_title' => '',		//메뉴명
	        'total' => 0,			//평가의견수
	        'average' => '',		//평균점수
	        'data' => array()		//의견 데이터
	    );
	    
	    //메뉴명 구하기
	    $positionArr = Menu::getPositionArray($no);
	    $data['menu_title'] = Menu::makePositionHtml($positionArr, true);
	    
	    
	    //의견데이터 구하기
	    $query = "SELECT * FROM ".COMPLAIN_TABLE.$where." ORDER BY writetime DESC".$limit;
	    $dbData = $this->db->getDBData($query);
	    
	    for($i = 0; $i < count($dbData); $i++){
	       $_menu_id = intval($dbData[$i]['menu_id']);
	       
	       $positionArr = Menu::getPositionArray($_menu_id);
	       $dbData[$i]['menu_title'] = Menu::makePositionHtml($positionArr, true);
	    }
	    return $dbData;
	}
	
	
	
	public function delete($no = 0){
		if($no == 0) return;
		
		$query = "DELETE FROM ".COMPLAIN_TABLE." WHERE indexcode = ".$no;
		$this->db->runQuery($query);
		
	}
	
}