<?php 
include_once COMMON_PATH."lib/db.class.php";
class Menu extends DB{
	
	public $menu_table = 'menuinfo';
	public $menu_type_array = array( 1 => "gnb", 2 => "lnb", 3 => "sitemap");
	public $db;

	/**
	 * 생성자 함수
	 */
	public function __construct($dbInfo = null){
		$this->db = new DB();
	}
	
	
	/**
	 * 등록된 메뉴인지 체크하는 함수
	 * @param number $id
	 */
	public function isCorrectMenuCheck($id = 0)
	{
	 
	    $id = intval($id);
	    if($id < 0) $id = 0;
	    
	    if($id > 0)
	    {
	        $is_correct_menu = false;
	        $query = "SELECT count(*) FROM ".$this->menu_table." WHERE site = '".SITE_NAME."' AND menu_id = ".$id;
	        $menuData = $this->db->getDBData($query);
	        
	        if($menuData[0][0] > 0) $is_correct_menu = true;
	        
	        if(!$is_correct_menu)
	        {
	            header("location:./");
	             
	        }
	    }else{
	        
	        if($id == 0 && isset($_GET['menu']))  header("location:./");
	       
	    }
		
	}
	
	/**
	 * 메뉴 id 값에 해당하는 메뉴 정보 한 행을 얻는다.
	 * @param number $id
	 */
	public function getMenuInfo($id = 0){
	    
	    if(intval($id) > 0){
	       $query = "SELECT * FROM ".$this->menu_table." WHERE menu_id = ".$id;
            $menuData = $this->db->getDBData($query);
    	    return $menuData[0];
            
	    }else return null;
	    
	}
	
	
	/**
	 * 메뉴 정보를 ul > li > a 형식으로 생성
	 * @param number $id 메뉴 id 기준으로 하위 메뉴 탐색
	 * @param number $depth 메뉴 랭크 시작
	 * @param number $depth_end 메뉴 랭크 끝
	 * @param number $menuhide_type_num 메뉴 숨김 타입 ( 1. gnb, 2. sidebar, 3. sitemap ) 
	 * @param string $root_class 최상위 ul 태그에 적용할 클래스명
	 * $depth가 1이고 $depth_end 가 3이면 1차메뉴부터 3차메뉴까지 생성함.
	 * 메뉴 id 값을 기준으로 하위메뉴를 탐색하며 하위메뉴가 없을떄까지 재귀호출하여 메뉴를 생성함.
	 */
	public function makeMenuHtml($id = 0, $depth = 1, $depth_end = 0, $menuhide_type_num = 0, $root_class = ""){
	
		$query = "SELECT menu_id, rank, menu_order FROM ".$this->menu_table." WHERE site = '".SITE_NAME."' AND parent_id = '{$id}' AND rank = {$depth}";
		if($menuhide_type_num != 0) $query .= " AND menu_hide".$menuhide_type_num." != 1";
		$query .= " ORDER BY menu_order ASC";
	
		$menuData = $this->db->getDBData($query);
		
		$active_menu_array = $this->getActiveMenuArray();
	
		$html = "";
		$prefix = ($menuhide_type_num != 0) ? $this->menu_type_array[$menuhide_type_num] : "";
	
		if($depth_end == 0 || $depth - 1 < $depth_end)
		{
			if( count($menuData) > 0)
			{
				if($root_class != "") $_ul = " class=\"{$root_class}\"";
				else $_ul = "";
	
				$html .= str_repeat("\t", $depth * 2 - 1)."<ul{$_ul}>".PHP_EOL;
	
				$i = 0;
				for($i = 0; $i < count($menuData); $i++)
				{
					$id = intval($menuData[$i]['menu_id']);
					$rank = intval($menuData[$i]['rank']);
					$depth = $menuData[$i]['rank'] + 1;
						
					$class_value = "";
					//1차메뉴에만 클래스 적용
					if($rank == 1)
						$class_value = $prefix.($i+1);
							
						//현제 선택된 메뉴의 상위 메뉴에 클래스 적용
						if(isset($active_menu_array) && in_array($id, $active_menu_array)){
							$class_value .= ($class_value != "") ? " " : "";
							$class_value .= $this->menu_type_array[$menuhide_type_num]."Active";
						} 
						$class = ($class_value != "") ? " class=\"{$class_value}\"" : "";
							
							
						$html .= str_repeat("\t", $rank * 2)."<li{$class}>".PHP_EOL.str_repeat("\t", $rank * 2 + 1);
						$html .= $this->getMenuLink($menuData[$i]['menu_id']).PHP_EOL;
						$html .= $this->makeMenuHtml($id, $depth, $depth_end, $menuhide_type_num);
						$html .= str_repeat("\t", $rank * 2)."</li>".PHP_EOL;
				}
				$html .= str_repeat("\t", $rank * 2 - 1)."</ul>".PHP_EOL;
			}
		}
	
	
		return $html;
	}
	
	
	
	/**
	 * 메뉴 id에 해당하는 메뉴의 a태그를 생성.(href, title, target)
	 * @param unknown $id
	 */
	public function getMenuLink($id, $_class = null)
	{
	
		$query = "SELECT menu_title, second_id, menu_type, href, target FROM ".$this->menu_table." WHERE menu_id = ".$id;
		$dbData = $this->db->getDBData($query);
		$row = $dbData[0];
		$url = "";
		$site_url = "?menu=";
		$target = "";
		$class = '';
		if($_class != "") $class = ' class="'.$_class.'"';
		
	
		//하위메뉴가 있는지 체크
		
		if($row['second_id'] != 0)
		{
			$query = "SELECT menu_type, href, target FROM ".$this->menu_table." WHERE menu_id = ".$row['second_id'];
			$dbData2 = $this->db->getDBData($query);
			if(count($dbData2) > 0)
			{
				$second_menu_exists = true; 
			}else{
				$second_menu_exists = false;
			}
		}else{
			$second_menu_exists = false;
		}
		
	
		if($second_menu_exists)
		{
			$row2 = $dbData2[0];
	
			if($row2['menu_type'] == "link")
			{
				$url = $row2['href'];
			}else
			{
				$url = $site_url.$row['second_id'];
			}
	
			if($row2['target'] == "B") $target = " target=\"_blank\"";
	
		}else
		{
			if($row['menu_type'] == "link")
			{
				$url = $row['href'];
			}else
			{
				$url = $site_url.$id;
			}
	
			if($row['target'] == "B") $target = " target=\"_blank\"";
		}
		
	
		if($url == "")
			$url = "#";
	
			$href = "href=\"{$url}\"";
	
	
			if($target != "")
				$t_title = "새창으로 ";
				else
					$t_title = "";
	
					$title = " title=\"{$t_title}{$row['menu_title']} 메뉴로 이동하기\"";
	
					$link_html = "<a {$href}{$target}{$title}{$class}";
					$link_html .= ">";
					$link_html .= $row['menu_title'];
					$link_html .= "</a>";
					return $link_html;
	}
	
	
	/**
	 * 사이트의 모든 차수의 메뉴를 생성하여 html로 리턴
	 */
	public function makeAllMenuHtml(){
		
		$query = "SELECT menu_id FROM ".$this->menu_table." WHERE site = '".SITE_NAME."' AND parent_id = 0 AND rank = 1 AND menu_hide1 != 1 ORDER BY menu_order ASC";
		$menuData = $this->db->getDBData($query);
		
		$html = "<div class=\"allmenu\">";
		$i = 1;
		foreach($menuData as $value){
			$_id = intval($value['menu_id']);
			$html .= $this->makeMenuHtml($_id, 2 , 3, 1 , "subm sub".$i);
			$i++;
		}
		$html .= "</div>";
		
		return $html;
	}
	
	
	/**
	 * lnb에 해당하는 메뉴를 생성하여 html로 리턴함.
	 */
	public function makeLnbMenuHtml(){
		
		global $menuID;
		$positions = $this->getPositionArray($menuID);
		
		$depth1_title =  $positions[count($positions) - 1]['menu_title'];
		$depth1_menuid = $positions[count($positions) - 1]['menu_id'];
		
		if(count($positions) > 1)
			$depth2_title =  $positions[count($positions) - 2]['menu_title'];
		
		$html = "";
		$html .= "<div class=\"subnav-in\">";
		$html .= "<div class=\"subhome\"><a href=\"./\"><img src=\"img/subhome.png\" alt=\"home\"></a></div>";
		$html .= "<ul id=\"lnb\">";
		
		$html .= "<li class=\"lnb_area\"><a href=\"#\" class=\"lnb_n\" target=\"_self\">".$depth1_title."</a>";
		$html .= $this->makeMenuHtml(0, 1 , 1, 2, "lnb_list");
		$html .= "</li>";
		
		if(count($positions) > 1)
		{
			$html .= "<li class=\"lnb_area\"><a href=\"#\" class=\"lnb_n\" target=\"_self\">".$depth2_title."</a>";
			$html .= $this->makeMenuHtml($depth1_menuid, 2 , 2, 2, "lnb_list");
			$html .= "</li>";
		}
		
		$html .= "</ul>";
		$html .= "</div>";
		return $html;
	}
	
	
	/**
	 * 현재 선택된 메뉴 id 와 그 상위 메뉴 id를 모두 찾아서 배열로 리턴
	 */
	public function getActiveMenuArray(){
	
		$menuid = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
		
		$active_menu_array = array();
		
		$i = 0;
		while($menuid){
			if($i >= 10) break;
			
			array_push($active_menu_array, $menuid);
			$_data = $this->findParentData($menuid);
			$menuid = $_data['parent_id'];
			
			$i++;	
		}
		
		
		return $active_menu_array;
	}
	
	
	/**
	 * 메뉴 id 값을 기준으로 부모 메뉴 id값을 찾아줌.
	 * @param number $id
	 */
	public function findParentData($id = 0){
	    if(intval($id) > 0){
            $query = "SELECT * FROM ".$this->menu_table." WHERE menu_id = ".$id;
            $menuData = $this->db->getDBData($query);
            return $menuData[0];
	    }else {
	        return null;
	    }
	}
	
	/**
	 * 특정 메뉴 id 와 그 상위 메뉴 id를 모두 찾아서 배열로 리턴
	 * 
	 * @param number $id
	 */
	public function getPositionArray($id = 0){
	    
	    $position = array();
	    
	   
	    $repeat = 0;
	    while($id){
	        
	        if($repeat >= 10) break; //무한 루프 방지 
	        $data = $this->findParentData($id);
	        $id = intval($data['parent_id']);
	        $menu_title = trim($data['menu_title']);
	        array_push($position, $data);
	        
	        $repeat++;
	    }
	    
	    return $position;
	    
	}
	
	
	/**
	 * 메뉴의 계층구조를 html로 생성하여 리턴
	 * @param unknown $position
	 * @param string $strip_tag 태그 제거 여부
	 */
	public function makePositionHtml($position = null, $strip_tag = false){
	    $html = "";
	    
	    if($position != null){
	        
	        for($i = count($position) - 1; $i >= 0; $i--){
	            $id = $position[$i]['menu_id'];
	            if($strip_tag)
	            	$html .= strip_tags($this->getMenuLink($id));
	            else
	            	$html .= $this->getMenuLink($id);
	         
	            if($i != 0) $html .= " &gt; ";
	        }
	    }
	    return $html;
	    
	}
	
	
	
	
	/**
	 * makeMenuHtml 함수를 약간 변형하여 gnb 메뉴에 맞는 마크업 형태로 수정
	 */
	public function makeGnbMenuHtml($id = 0, $depth = 1, $depth_end = 0, $menuhide_type_num = 0, $root_class = ""){
	
		$query = "SELECT menu_id, rank, menu_order FROM ".$this->menu_table." WHERE site = '".SITE_NAME."' AND parent_id = '{$id}' AND rank = {$depth}";
		if($menuhide_type_num != 0) $query .= " AND menu_hide".$menuhide_type_num." != 1";
		$query .= " ORDER BY menu_order ASC";
	
		$menuData = $this->db->getDBData($query);
	
		$active_menu_array = $this->getActiveMenuArray();
	
		$html = "";
		$prefix = ($menuhide_type_num != 0) ? $this->menu_type_array[$menuhide_type_num] : "";
	
		if($depth_end == 0 || $depth - 1 < $depth_end)
		{
			if( count($menuData) > 0)
			{
				if($root_class != "") $_ul = " class=\"{$root_class}\"";
				else if ($depth == 2) $_ul = " class=\"subm\"";
				else $_ul = "";
	
				if($depth == 2){
				    if($menuhide_type_num != 3){
    				    $html .= "<div class=\"navSub\">";
				    }else{
    				    $html .= "<div>";
				    }
				}
				$html .= str_repeat("\t", $depth * 2 - 1)."<ul{$_ul}>".PHP_EOL;
	
				$i = 0;
				for($i = 0; $i < count($menuData); $i++)
				{
					$id = intval($menuData[$i]['menu_id']);
					$rank = intval($menuData[$i]['rank']);
					$depth = $menuData[$i]['rank'] + 1;
	
					//서브메뉴 개수 구하기
					$query = "SELECT count(*) FROM ".$this->menu_table." WHERE site = '".SITE_NAME."' AND parent_id = ".$menuData[$i]['menu_id'];
					$_data = $this->db->getDBData($query);
					$subCount = intval($_data[0][0]);
					
					$class_value = "";
					//1차메뉴에만 클래스 적용
					if($rank == 1)
						$class_value = $prefix.($i+1);
							
						//현제 선택된 메뉴의 상위 메뉴에 클래스 적용
						if(isset($active_menu_array) && in_array($id, $active_menu_array)){
							$class_value .= ($class_value != "") ? " " : "";
							$class_value .= $this->menu_type_array[$menuhide_type_num]."Active";
						}
						$class = ($class_value != "") ? " class=\"{$class_value}\"" : "";
							
						
						$html .= str_repeat("\t", $rank * 2)."<li{$class}>".PHP_EOL.str_repeat("\t", $rank * 2 + 1);
						if($depth - 1 == 2 && $subCount > 0){
    						$html .= $this->getMenuLink($menuData[$i]['menu_id'], "depth").PHP_EOL;
						}else{
    						$html .= $this->getMenuLink($menuData[$i]['menu_id']).PHP_EOL;
						}
						$html .= $this->makeGnbMenuHtml($id, $depth, $depth_end, $menuhide_type_num);
						$html .= str_repeat("\t", $rank * 2)."</li>".PHP_EOL;
				}
				$html .= str_repeat("\t", $rank * 2 - 1)."</ul>".PHP_EOL;
				if($depth == 2) $html .= "</div>";
			}
		}
	
	
		return $html;
	}
	
	
	
	
	
}
