<?php 
class MenuInfo extends Menu {
    
    var $siteKeyList;
    var $siteList;
    var $db;
    var $menuType = array('contents' => '컨텐츠', 'skin' => '게시판', 'link' => '링크');
    var $grantList = array(
            array('name' => 'auth_list', 'title' => '목록보기'),
            array('name' => 'auth_view', 'title' => '내용보기'),
            array('name' => 'auth_write', 'title' => '글쓰기'),
            array('name' => 'auth_comment', 'title' => '코멘트쓰기'),
            array('name' => 'auth_reply', 'title' => '답변쓰기'),
            array('name' => 'auth_alltag', 'title' => '모든 태그 사용'),
            array('name' => 'auth_gongji', 'title' => '공지사항 쓰기'),
            array('name' => 'auth_secret', 'title' => '비밀글 보기'),
            array('name' => 'auth_fileup', 'title' => '파일 업로드'),
            array('name' => 'auth_filedown', 'title' => '파일 다운로드'),
            array('name' => 'auth_admin', 'title' => '관리자 기능')
    );
	var $_site = '';
    var $incFiles = array();
    
    var $default_upload_size = 10;
    var $default_upload_upit = "MB";
    var $default_list_limit_num = 10;
    var $default_submit_limit_num = 0;
    
    function __construct(){
    	
    	
        $siteList = getSiteList();
        foreach($siteList as $key => $value){
            $this->siteKeyList[] = $key;
            $this->siteList[$key] = $value; 
        }
        
        $this->db = new DB();
        
    }
    
    
    public function getMenuList($id = 0, $depth = 1){
        global $siteKey, $MENU ;
    
       
        $query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteKey}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
        $dbData = $this->db->getDBData($query);
        $total = count($dbData);
        if($total > 0)
        {
            for($i = 0; $i < count($dbData); $i++)
            {
                	
                $id = $dbData[$i]['menu_id'];
                $depth = $dbData[$i]['rank'] + 1;
                	
                //하위 카테고리 개수 구하기
                $delete = $this->menuDeleteCheck($dbData[$i]['menu_id']);
                $_backUrl = urlencode(getBackUrl('menu|site|mode|pagetype', 1));
                echo "<tr class=\"depth{$dbData[$i]['rank']}\">".PHP_EOL;
                
                //메뉴값
                echo "<td>".$dbData[$i]['menu_id']."</td>".PHP_EOL;
                
                $positionArr = MENU::getPositionArray($id);
                $_menu_title = MENU::makePositionHtml(MENU::getPositionArray($id), true);
                
                echo "<td class=\"tleft menu_title\" title=\"". $_menu_title."\">";
                if($dbData[$i]['rank'] != 1) echo "<img src=\"".SKIN_URL."img/icon_catlevel.gif\" />&nbsp;";
                
                $shortCutLink = "";
                if($dbData[$i]['second_id']){
                	$query = "SELECT href, menu_type, site FROM ".MENU_TABLE." WHERE menu_id = ".$dbData[$i]['second_id'];
                	$sLinkData = $this->db->getDBData($query);
                	if($sLinkData[0]['menu_type'] == "link"){
                		$shortCutLink = $sLinkData[0]['href'];
                	}else{
                		$shortCutLink = BASE_URL."/".$sLinkData[0]['site']."/?menu=".$dbData[$i]['second_id'];
                	}
                	
                }else{
                	if($dbData[$i]['menu_type'] == "link"){
                		$shortCutLink = $dbData[$i]['href'];
                	}else{
	                	$shortCutLink = BASE_URL."/".$dbData[$i]['site']."/?menu=".$id;
                	}
                }
                
                //메뉴명
                echo "<span class=\"title_output\">".$dbData[$i]['menu_title']."</span>";
                echo "<input type=\"text\" class=\"title_input inputs hide\" data-no=\"".$dbData[$i]['menu_id']."\" value=\"".$dbData[$i]['menu_title']."\" />";
                echo "<a href=\"".$shortCutLink."\" class=\"in_btn\" target=\"_blank\" style=\"margin-left:5px\">바로가기</a>";
                echo "</td>".PHP_EOL;
                	
                $menuTypeText = isset($this->menuType[$dbData[$i]['menu_type']]) ? ucfirst($this->menuType[$dbData[$i]['menu_type']]) : "";
                
                //메뉴타입
                echo "<td><span class=\"menu_type_icon type_".$dbData[$i]['menu_type']."\">".$menuTypeText."</span></td>".PHP_EOL;
                
                //메뉴차수
                echo "<td>".$dbData[$i]['rank']."차</td>".PHP_EOL;

                //하위메뉴
                $_secondID = ($dbData[$i]['second_id'] != 0) ? $dbData[$i]['second_id'] : "";
                echo "<td>".$_secondID."</td>".PHP_EOL;
                	
              
                //페이지바디
                echo "<td>".PHP_EOL;
                echo "<span class=\"body_output\">".$dbData[$i]['bodyfile']."</span>".PHP_EOL;
                
                $bodyData = $this->getBodyFileList($siteKey);
                if(count($bodyData)){
                    echo "<select class=\"body_input inputs hide\" name=\"body_name\" data-no=\"".$dbData[$i]['menu_id']."\">".PHP_EOL;
                    foreach($bodyData as $_file){
                        echo "<option value=\"".$_file."\" ".isselected($dbData[$i]['bodyfile'], $_file).">".$_file."</option>".PHP_EOL;
                    }
                    echo "</select>".PHP_EOL;
                }
                echo "</td>".PHP_EOL;
                
                
                //메뉴새창
                $target_txt = ($dbData[$i]['target'] == "S") ? "현재창" : "새창";
                $target_apply = $dbData[$i]['target'] == "S" ? "B" : "S";
                
                echo "<td><a href=\"#\" data-no=\"".$dbData[$i]['menu_id']."\" class=\"quick_target\">".$target_txt."</a></td>".PHP_EOL;

                
                //스킨명
                $_skin_path = "";
                echo "<td>".PHP_EOL;
                if($dbData[$i]['menu_type'] == "skin")
                {
	                $_skin_path = isset($dbData[$i]['skin']) && $dbData[$i]['skin'] != "" ? $dbData[$i]['skin_group']."/".$dbData[$i]['skin'] : "";
	                echo "<span class=\"skin_output\">".$_skin_path."</span>".PHP_EOL;
	                $skinData = $this->getSkinData($siteKey);
	                if(count($skinData) > 0){
	                    echo "<select class=\"skin_input inputs hide\" name=\"skin_name\" data-no=\"".$dbData[$i]['menu_id']."\">".PHP_EOL;
	                    foreach($skinData as $groupName => $group){
	                        echo "<optgroup label=\"".$groupName."\">".PHP_EOL;
	                        if(count($group) > 0){
	                            
	                            foreach($group as $skinName){
	                                $skinPathName = $groupName."/".$skinName;
	                                echo "<option value=\"".$skinPathName."\" ".isselected($skinPathName, $_skin_path).">".$skinName."</option>".PHP_EOL;
	                            }
	                            
	                        }
	                        echo "</optgroup>".PHP_EOL;
	                    }
	                    echo "</select>".PHP_EOL;
	                }
                }else if($dbData[$i]['menu_type'] == 'contents'){
                    $query = "SELECT count(*) FROM ".CONTENTS_TABLE." WHERE menu_id = ".$dbData[$i]['menu_id'];
                    $_data = $this->db->getDBData($query);
                    echo $_data[0][0] > 0 ? $_data[0][0] : "";
                }
              
                echo "</td>".PHP_EOL;
                
            
                //메뉴숨김
                $menu_hide1_txt = ($dbData[$i]['menu_hide1']) ? "숨김" : "노출";
                $menu_hide2_txt = ($dbData[$i]['menu_hide2']) ? "숨김" : "노출";
                $menu_hide3_txt = ($dbData[$i]['menu_hide3']) ? "숨김" : "노출";
    
                $hide1_apply =  $dbData[$i]['menu_hide1'] == 1 ? 0 : 1;
                $hide2_apply =  $dbData[$i]['menu_hide2'] == 1 ? 0 : 1;
                $hide3_apply =  $dbData[$i]['menu_hide3'] == 1 ? 0 : 1;
    
                
                echo "<td><a href=\"#\" data-column=\"1\" data-no=\"".$dbData[$i]['menu_id']."\" class=\"quick_hide\">".$menu_hide1_txt."</a></td>".PHP_EOL;
                echo "<td><a href=\"#\" data-column=\"2\" data-no=\"".$dbData[$i]['menu_id']."\" class=\"quick_hide\">".$menu_hide2_txt."</a></td>".PHP_EOL;
                echo "<td><a href=\"#\" data-column=\"3\" data-no=\"".$dbData[$i]['menu_id']."\" class=\"quick_hide\">".$menu_hide3_txt."</a></td>".PHP_EOL;
    
                //수정
                echo "<td><a href=\"".getBackUrl('menu|pagetype|site')."&mode=update&no=".$dbData[$i]['menu_id']."\" class=\"in_btn btn_modify\">수정</a></td>".PHP_EOL;
                
                //삭제
                echo "<td>";
                if($delete)
                    echo "<a href=\"".SKIN_URL."delete.php?no=".$dbData[$i]['menu_id']."&site={$siteKey}&backUrl=".urlencode(getBackUrl('menu|pagetype|site|mode', 1))."\" class=\"in_btn btn_delete menu_delete\">삭제</a>";
                    echo "</td>".PHP_EOL;
                    echo "</tr>".PHP_EOL;
                   $this->getMenuList($id, $depth);
            }
        }else{
            
            if($depth == 1)
            {
                echo "<tr>".PHP_EOL;
    			echo "<td colspan=\"13\">등록된 메뉴가 없습니다.</td>".PHP_EOL;
                echo "</tr>".PHP_EOL;
            }
        }
    
    
    }
    
    public function getArrangeList($id = 0, $depth = 1){
        global $siteKey ;
    
       
        $query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteKey}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
        $dbData = $this->db->getDBData($query);
        $total = count($dbData);
        
        if($total > 0)
        {
        	echo "<ul>".PHP_EOL;
            for($i = 0; $i < count($dbData); $i++)
            {
                	
                $id = $dbData[$i]['menu_id'];
                $depth = $dbData[$i]['rank'] + 1;
                echo "<li class=\"depth".$dbData[$i]['rank']."\" data-no=\"".$id."\">";
                echo $dbData[$i]['menu_title'];
              
                $this->getArrangeList($id, $depth);
                
                echo "</li>".PHP_EOL;
                
                
                
            }
            
            echo "</ul>".PHP_EOL;
        }else{
            
            if($depth == 1)
            {
    			echo "<div>등록된 메뉴가 없습니다.</div>";
            }
        }
    
    
    }
    
    
    public function menuArrange($post = null){
        
        
        $arrangeList = explode(";|;", $post['arrangeText']);
        
        $column = $this->db->getColumns(MENU_TABLE, array('parent_id', 'rank', 'menu_order'), true);
        
        foreach($arrangeList as $value){
            if($value == '') continue;
            $arr = explode("|", $value);
            $data = array();
            $data['menu_id'] = $arr[0];
            $data['parent_id'] = $arr[1];
            $data['menu_order'] = $arr[2];
            $data['rank'] = $arr[3];
            
            $query = $this->db->updateSql($column, $data, MENU_TABLE, 'menu_id');
            $this->db->runQuery($query);
        }
    }
    
    
    /**
     * 메뉴 삭제 가능 여부 <br />
     * 하위 메뉴가 없을 경우에만 삭제 가능
     */
    public function menuDeleteCheck($id = 0)
    {
        global $TABLE, $dbConnSelect;
        $delete = false;
    
        if($id)
        {
            $query = "SELECT count(*) FROM ".MENU_TABLE." WHERE parent_id = ".$id;
            $dbData = $this->db->getDBData($query);
            if( $dbData[0][0]== 0 ) $delete = true;
        }
    
        return $delete;
    }
    
    
    public function getMenuInfo($id = 0, $site = ''){
         
        if(intval($id) > 0){
            $query = "SELECT * FROM ".$this->menu_table." WHERE site = '".$site."' AND menu_id = ".$id;
            $menuData = $this->db->getDBData($query);
            return $menuData[0];
    
        }else return null;
         
    }
    
    
    
    
    public function getMenuHierarchy($id = 0)
    {
        $position = parent::getPositionArray($id);
        $text = parent::makePositionHtml($position);
        $text = strip_tags($text);
        return $text;
    }
    
    
    

    public function getSecondMenuOption($id, $depth, $siteName = null, $update_mode_second_id = null)
    {
        $query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteName}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
        $dbData = $this->db->getDBData($query);
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
    
                $this->getSecondMenuOption($id, $depth, $siteName, $update_mode_second_id);
            }
        }else
        {
    
        }
    }
    
    

    /**
     * 메뉴 등록,수정시 상위 메뉴를 선택 할 수 있게 select 태그안의 option 리스트를 뿌려줌.
     * @param int $id (메뉴코드값)
     * @param int $depth (메뉴차수)
     * @param int $update_mode_menuid (수정모드시 DB에 저장된 메뉴코드값)
     */
    public function getMenuOption($id, $depth, $siteName = null, $update_mode_menuid = null, $update_mode_parentID = null)
    {
        $query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteName}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
        $dbData = $this->db->getDBData($query);
        $total = count($dbData);
    
        if($total > 0)
        {
            for($i = 0; $i < count($dbData); $i++)
            {
                if($update_mode_parentID) $selected = isselected($update_mode_parentID, $dbData[$i]['menu_id']);
                else $selected = "";
    
                $id = $dbData[$i]['menu_id'];
                $depth = $dbData[$i]['rank'] + 1;
                if($id != $update_mode_menuid)
                    echo "<option value=\"{$dbData[$i]['menu_id']}\" {$selected}>".str_repeat("&nbsp;&nbsp;&nbsp;", $depth - 1).$dbData[$i]['menu_title']."</option>";
                    $this->getMenuOption($id, $depth, $siteName, $update_mode_menuid, $update_mode_parentID);
            }
        }else
        {
    
        }
    }
    
    
    public function getBodyFileList($site = null){
        
        $bodyFiles = array();
        if($site != null)
        {
            $dir = BASE_PATH."/".$site."/layout/";
            $site = array();
            $d = dir($dir);
            while ($entry = $d->read()) {
            
                if ($entry != '.' && $entry != '..') {
                    
                    $pos = strpos($entry, "body");
                    if($pos !== false){
                        array_push($bodyFiles, $entry);
                    }
                    
                }
            }
        }
        
        rsort($bodyFiles);
        return $bodyFiles;
    }
    
    
    public function getIncFileList($site = null){
        
        $incFiles = array();
        $incText = "";
        if($site != null)
        {
            $path = BASE_PATH."/".$site."/inc/";
            $this->_site = $site;
        }
        
        $this->incDirCheck($path);
        rsort($this->incFiles);
        return $this->incFiles;
    }
    
    
    private function incDirCheck($path = ''){
    	
    	setlocale(LC_ALL,'ko_KR.UTF-8');	//한글 폴더명을 가진 path 에서도 basename 함수가 정상 동작하도록 설정
    	$d = dir($path);
    	$base_path = str_replace(BASE_PATH."/".$this->_site."/inc/", '', $path);
    	
    	while ($entry = $d->read()) {
    		if($entry == '.' || $entry == '..') continue;
    		$isdir = is_dir($path.$entry);
    		$newPath = $path.$entry."/";
    		if($isdir){
    			$this->incDirCheck($newPath);
    		}else{
    			$file = $base_path.$entry;
    			array_push($this->incFiles, $file);
    		}
    	}
    	
    }
    
    
    public function getSkinData($site = null){
        
        if($site != null){
            
            $skinData = array();
            $skinPath = BASE_PATH."/".$site."/skin/";
            $skinDir = dir($skinPath);
            while ($entry = $skinDir->read()) {
                if ($entry != '.' && $entry != '..' & $entry != "base")
                {
                	$skinData[$entry] = array();
                	
                    $skinGroupPath = $skinPath.$entry."/";
                    $skinGroupDir = dir($skinGroupPath);
                      while ($entry2 = $skinGroupDir->read()) {
                          if ($entry2 != '.' && $entry2 != '..')
                          {
                          	array_push($skinData[$entry], $entry2);
                          	sort($skinData[$entry]);
                          }
                      }
                    
                    
                }
            }
            
        }
        return $skinData;
        
    }
    
    
    /**
     * 그룹 정보를 선택할 수 있게 select 태그안에 option 리스트를 뿌려줌.
     */
    public function getGroupOption($selected_data = ""){

        
        $query = "SELECT * FROM ".GROUP_TABLE." GROUP BY groupname ORDER BY authlevel DESC";
        $groupData = $this->db->getDBData($query);
        
        foreach($groupData as $value){
            echo "<optgroup label=\"".$value['groupname']."\">".PHP_EOL;
            
            $query = "SELECT * FROM ".GROUP_TABLE." WHERE groupname = '{$value['groupname']}' ORDER BY authlevel DESC";
            $groupData2 = $this->db->getDBData($query);
            
            foreach($groupData2 as $value2){
            	$selected = isselected($selected_data, $value2['authlevel']);
                
                echo "<option value=\"".$value2['authlevel']."\" {$selected}>".$value2['name']."</option>";
            }
            echo "</optgroup>".PHP_EOL;
        }
        
        return;
        
        $groupDBData = getDBData($dbConnSelect, $query);
    
        $groupData = array();
        for($i = 0; $i < count($groupDBData); $i++)
        {
            $rank = $groupDBData[$i]['groupRank'];
            $groupData[$rank]['name'] = $groupDBData[$i]['groupName'];
            $groupData[$rank]['mem'][] = $groupDBData[$i];
        }
    
        foreach($groupData as $value)
        {
            echo "<optgroup label=\"".$value['name']."\">";
            foreach($value['mem'] as $value2)
            {
                if($selected_data != null) $selected = isselected($selected_data, $value2['authlevel']);
                else $selected = "";
                echo "<option value=\"".$value2['authlevel']."\" {$selected}>".$value2['groupMemList']."</option>";
            }
            echo "</optgroup>";
        }
    }
    
    
    public function getDBTableList(){
        $query = "SHOW TABLE STATUS LIKE 'inner%'";
        $dbData = $this->db->getDBData($query);
        
        $tables = array();
        foreach($dbData as $value){
            array_push($tables, $value['Name']);
        }
        return $tables;
    }
	
}
