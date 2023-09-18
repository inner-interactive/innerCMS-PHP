<?php 
class PageView{
	var $siteKeyList;
	var $sitekey;
	var $menuList = array();
	
	function __construct(){
		$siteList = getSiteList();
		foreach($siteList as $key => $value){
			$this->siteKeyList[] = $key;
			$this->siteList[$key] = $value;
		}
		
		$this->siteKey = isset($_GET['site']) ? trim($_GET['site']) : 'main';
		$this->getPageViewMenuList();
	}
	
	public function getTotal(){
		global $DB;
		$query = "SELECT SUM(page_count) FROM ".VISIT_PAGEVIEW_TABLE." WHERE site = '".$this->siteKey."'";
		$dbData = $DB->getDBData($query);
		$total = $dbData[0][0];
		return $total;
	}
	
	public function getCount($menu_id = 0){
		global $DB;
		$query = "SELECT page_count FROM ".VISIT_PAGEVIEW_TABLE." WHERE site = '".$this->siteKey."' AND menu_id = ".$menu_id;
		$dbData = $DB->getDBData($query);
		$count = $dbData != null ? intval($dbData[0]['page_count']) : 0;
		return $count;
	}
	
	public function getPageViewMenuList($id = 0, $depth = 1){
		global $DB;
	
		$query = "SELECT menu_id, menu_title, rank FROM ".MENU_TABLE." WHERE site = '".$this->siteKey."' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
		$dbData = $DB->getDBData($query);
		$total = count($dbData);
		if($total > 0)
		{
			for($i = 0; $i < count($dbData); $i++)
			{
				
				array_push($this->menuList, $dbData[$i]);
	
				$id = $dbData[$i]['menu_id'];
				$depth = $dbData[$i]['rank'] + 1;
				$this->getPageViewMenuList($id, $depth);
			}
		}else{
		}
	
	
	}
	
}

