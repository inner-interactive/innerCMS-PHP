<?php 
class OrgInfo {
	
	var $db;
	var $table = ORG_TABLE;
	
	function __construct($db){
	
		$this->db = $db;
	}
	
	
	
	/**
	 * 조직 구성원 수정시 소속 변경할 수 있도록 select태그의 option html을 생성
	 * @param number $id
	 * @param number $depth
	 */
	public function getOrgTeamSelectOption($id = 0, $depth = 0, $selected_id = 0, $select_down = false){
	    
	    $query = "SELECT org_id, org_name, org_depth FROM ".$this->table." WHERE org_parent = $id AND org_depth = $depth AND org_type = 'team' ORDER BY org_sort ASC";
	    $dbData = $this->db->getDBData($query);
	    if(count($dbData) > 0){
	        
	        foreach($dbData as $value){
	            
	            $id = $value['org_id'];
	            $depth = $value['org_depth'] + 1;
	            
	            //하위조직이 존재하는지 체크
	            $query = "SELECT count(*) FROM ".$this->table." WHERE org_type = 'team' AND org_parent = ".$id." AND org_depth = $depth";
	            $dbData2 = $this->db->getDBData($query);
	            $count = intval($dbData2[0][0]);
	            
	            $seledcted = $id == $selected_id ? " selected=\"selected\"" : "";
	            if($count && $select_down){
	                
	                echo str_repeat("\t", $depth)."<optgroup label=\"".$value['org_name']."\">".str_repeat("&nbsp;", $depth - 1)."".PHP_EOL;
	            }else{
	                echo str_repeat("\t", $depth)."<option value=\"".$value['org_id']."\"".$seledcted.">".str_repeat("&nbsp;", $depth - 1).$value['org_name']."</option>".PHP_EOL;
	            }
	            
	            
	            $this->getOrgTeamSelectOption($id, $depth, $selected_id, $select_down);
	            
	            if($count && $select_down){
	                echo "</optgroup>".PHP_EOL;
	            }
	        }
	        
	    }
	    
	}
	
	
	/**
	 * 팀(부서명) 리스트를 html 태그로 생성
	 * @param number $id
	 * @param number $depth
	 */
	public function getTeamList($id = 0, $depth = 0, $selected = 0, $mode = 'update'){
	
		$query = "SELECT org_id, org_name, org_depth, org_parent, menu_id FROM ".$this->table." WHERE org_parent = $id AND org_depth = $depth AND org_type = 'team' ORDER BY org_sort ASC";
		$dbData = $this->db->getDBData($query);
	
		if(count($dbData) > 0){
		?>
			
		<ul>
		<?php 
			foreach($dbData as $value){
	
				$id = $value['org_id'];
				$depth = $value['org_depth'] + 1;
	
				$delete = $this->deleteCheck($id);
				$li_class = "org_list depth".$depth;
				if($id == $selected) $li_class .= " selected";
				
				$memberCount = $this->getMemberCount($id);
                
		?>
				<li class="<?=$li_class?>">
				
					<div class="info_box" id="<?=$value['org_id']?>">
						<?php
						$href = $mode == 'update' || $mode == 'menu' ? getBackUrl('menu|mode|action')."&no=".$value['org_id'] : "#";
						$class = $mode == 'update' || $mode == 'menu' ? 'org_name' : 'org_name arrange_box';
						?>
						<a href="<?=$href?>" class="<?=$class?>"><?=$value['org_name']?></a>
						<?php if($memberCount > 0) echo "( ".$memberCount." )";?>
						<?php if($mode == 'menu'){
							echo $this->getMenuHierarchy($value['menu_id']); 
						}?>
					</div>
					<?php if($mode == 'update' || $mode == 'menu'){?>
					<div class="edit_box">
						<input type="text" name="org_name[<?=$value['org_id']?>]" class="inputs w200 name_input" style="margin-right:5px" value="<?=$value['org_name']?>" />
						<input type="submit" class="in_btn btn_apply" data-id="<?=$value['org_id']?>" style="margin-right:5px" value="저장" />
						<a href="#" class="in_btn btn-default edit_cancel">취소</a>
					</div>
					<?php if($mode == 'update'){?>
					<div class="func_box">
						<a href="#" class="in_btn btn_apply team_write_open_btn" data-id="<?=$value['org_id']?>">등록</a>
						<a href="#" class="in_btn btn_modify edit_btn" >수정</a>
					<?php if($delete == 0){ ?>
						<a href="<?=SKIN_URL?>delete.php?no=<?=$id?>&backUrl=<?=urlencode(getBackUrl('menu|mode', 1))?>" class="in_btn btn_delete delete">삭제</a>
					<?php } ?>
					</div>
					<?php }?>
					<?php }else if($mode == 'arrange'){?>
					<input type="hidden" name="arrange[<?=$value['org_parent']?>][]" value="<?=$value['org_id']?>" />
					<?php }?>
				<?php 
				$this->getTeamList($id, $depth, $selected, $mode);
				?>
				</li>
				<?php 	
			}
			?>
			</ul>
		<?php 
	
		}
	
	}
	
	public function getTeamCount(){
		$query = "SELECT count(*) FROM ".$this->table." WHERE org_type = 'team'";
		$dbData = $this->db->getDBData($query);
		return intval($dbData[0][0]);
	}
	
	
	/**
	 * 조직 구성원 데이터를 html로 리턴
	 * @param number $no
	 */
	public function getMemberModifyList($no = 0){
	
		//팀(부서명) 구하기
		$teamName = $this->getTeamNameAll($no);
		 
		//멤버 목록 구하기
		$query = "SELECT * FROM ".$this->table." WHERE org_parent = ".$no." AND org_type ='member' ORDER BY org_sort ASC";
		$dbData = $this->db->getDBData($query);
	
		?>
			
		<table class="table_basic th-g">
			<caption><?=$teamName?></caption>
			<thead>
				<tr>
					<th>성명</th>
					<th>팀(부서)</th>
					<th>직위(직급)</th>
					<th>전화번호</th>
					<th>이메일</th>
					<th>담당업무</th>
					<th>삭제</th>
				</tr>
			</thead>
			<tbody>
		<?php 
		if(count($dbData) > 0){
		    for($i = 0; $i < count($dbData); $i++){
	    ?>
				<tr>
					<td><input type="text" name="name[<?=$dbData[$i]['org_id']?>]" value="<?=$dbData[$i]['name']?>" class="inputs w100" /></td>
					<td>
						<select name="org_parent[<?=$dbData[$i]['org_id']?>]" >
							<?php $this->getOrgTeamSelectOption(0, 0, $dbData[$i]['org_parent'])?>
						</select>
					</td>
					<td><input type="text" name="position[<?=$dbData[$i]['org_id']?>]" value="<?=$dbData[$i]['position']?>" class="inputs w100" /></td>
					<td><input type="text" name="tel[<?=$dbData[$i]['org_id']?>]" value="<?=$dbData[$i]['tel']?>" class="inputs w100" /></td>
					<td><input type="text" name="email[<?=$dbData[$i]['org_id']?>]" value="<?=$dbData[$i]['email']?>" class="inputs w100" /></td>
					<td><textarea name="work[<?=$dbData[$i]['org_id']?>]" style="width:90%; height:60px" class="inputs"><?=$dbData[$i]['work']?></textarea></td>
					<td><a href="<?=SKIN_URL?>delete.php?no=<?=$dbData[$i]['org_id']?>&backUrl=<?=urlencode(getBackUrl('menu|no', 1))?>" class="in_btn btn_delete delete">삭제</a></td>
				</tr>
		<?php
		    }
	    }else{?>
				<tr>
					<td colspan="7">등록된 조직 구성원이 없습니다.</td>
				</tr>
		<?php }?>
		</tbody>
		</table>
	
	
	<?php 
	}
	
	
	public function getMemberArrangeList($no = 0){
		
		//멤버 목록 구하기
		$query = "SELECT * FROM ".$this->table." WHERE org_parent = ".$no." AND org_type ='member' ORDER BY org_sort ASC";
		$dbData = $this->db->getDBData($query);
		
		if(count($dbData) > 0){
		?>
		<ul id="arrange" class="arrange_list">
		<?php 
			for($i = 0; $i < count($dbData); $i++){
			?>
			<li>
				<span><?=$dbData[$i]['name']?></span>
				<span><?=$dbData[$i]['position']?></span>
				<input type="hidden" name="arrange[]" value="<?=$dbData[$i]['org_id']?>" />
			</li>			
			<?php 
			}
		?>
		</ul>
		<?php 
		}
	}
		
	
	/**
	 * 팀(부서)에 등록된 조직 구성원 수를 리턴
	 * @param number $no
	 */
	public function getMemberCount($no = 0){
		$query = "SELECT count(*) FROM ".$this->table." WHERE org_parent = ".$no." AND org_type = 'member'";
		$dbData = $this->db->getDBData($query);
		
		return intval($dbData[0][0]);
	}
		
	
	
	/**
	 * org_parent 값을 기준으로 org_code, org_sort, org_depth 값을 설정 
	 * @param number $org_parent
	 */
	private function setDefault($org_parent = 0){
	
		$data = array();
		$data['org_parent'] = $org_parent;
		
		if($org_parent > 0){
		
			$query = "SELECT org_code, org_depth FROM ".$this->table." WHERE org_id = ".$org_parent;
			$dbData = $this->db->getDBData($query);
			$data['org_code'] = $dbData[0]['org_code'].$org_parent.'/';
			$data['org_depth'] = $dbData[0]['org_depth'] + 1;
			
			$query = "SELECT max(org_sort) FROM ".$this->table." WHERE org_parent = ".$org_parent;
			$dbData = $this->db->getDBData($query);
			$data['org_sort'] = intval($dbData[0][0]) + 1;
		
		}else{
			$data['org_code'] = '/';
			$data['org_depth'] = 0;
		
			$query = "SELECT max(org_sort) FROM ".$this->table." WHERE org_depth = 0";
			$dbData = $this->db->getDBData($query);
			$data['org_sort'] = intval($dbData[0][0]) + 1;
		}
		
		return $data;
	}
	
	
	/**
	 * 팀(부서) 등록
	 * @param unknown $post
	 */
	public function teamWrite($post = null){
	
		$column = $this->db->getColumns($this->table, array('org_id', 'updatetime'));
		$column['writetime']['type'] = "now";
		$post['ip'] = $_SERVER['REMOTE_ADDR'];
		
		
		//기본 값 설정
		$org_parent =  isset($post['org_parent']) ? intval($post['org_parent']) : 0;
		$data = $this->setDefault($org_parent);
		
		foreach($data as $key => $value){
			$post[$key] = $value;
		}
		$post['org_type'] = 'team';
		
		$query = $this->db->insertSql($column, $post, $this->table);
		$this->db->runQuery($query);
	}
	
	

	/**
	 * 팀(부서)명 수정
	 * @param unknown $post
	 */
	public function teamUpdate($post = null){
	
	
		if(count($post['org_name']) > 0){
			$column = $this->db->getColumns($this->table, array('org_name', 'updatetime'), true);
			$column['updatetime']['type'] = "now";
				
			$data = array();
			foreach($post['org_name'] as $org_id => $org_name){
	
				if($org_name != ""){	//팀(부서)명이 없으면 수정하지 않음.
						
					$data['org_id'] = $org_id;
					$data['org_name'] = $org_name;
					$query = $this->db->updateSql($column, $data, $this->table, 'org_id');
					$this->db->runQuery($query);
				}
	
			}
				
		}
	
	
	}
	
	
	
	/**
	 * 팀(부서) 순서 변경
	 * @param unknown $post
	 */
	public function teamArrange($post = null){
	
		$column = $this->db->getColumns($this->table, array('org_sort'), true);
		foreach($post['arrange'] as $key => $value){
				
			foreach($value as $key2 => $value2){
			$data = array();
			$data['org_id'] = $value2;
			$data['org_sort'] = $key2 + 1;
				
			$query = $this->db->updateSql($column, $data, $this->table, 'org_id', 'org_id');
			$this->db->runQuery($query);
			
			}
		}
		
	}
	
	
	
	
	
	
	/**
	 * 조직 구성원 등록
	 * @param unknown $post
	 */
	public function memberWrite($post = null){
	
		$column = $this->db->getColumns($this->table, array('org_id', 'updatetime'));
		$column['writetime']['type'] = "now";
		$post['ip'] = $_SERVER['REMOTE_ADDR'];
		
		
		//기본 값 설정
		$org_parent =  isset($post['org_parent']) ? intval($post['org_parent']) : 0;
		$data = $this->setDefault($org_parent);
		
		foreach($data as $key => $value){
			$post[$key] = $value;
		}
		$post['org_type'] = 'member';
		
		$query = $this->db->insertSql($column, $post, $this->table);
		$this->db->runQuery($query);
	}
	
	
	
	/**
	 * 조직 구성원 수정
	 * @param unknown $post
	 */
	public function memberUpdate($post = null){
	
		$column = $this->db->getColumns($this->table, array('name', 'position', 'email', 'tel', 'work', 'org_parent', 'updatetime'), true);
		$column['updatetime']['type'] = "now";
		
		foreach($post['name'] as $key => $value){
			
			$data = array();
			$data['org_id'] = $key;
			$data['name'] = $value;
			$data['position'] = $post['position'][$key];
			$data['email'] = $post['email'][$key];
			$data['tel'] = $post['tel'][$key];
			$data['work'] = $post['work'][$key];
			$data['org_parent'] = $post['org_parent'][$key];
			
			
			$query = $this->db->updateSql($column, $data, $this->table, 'org_id', 'org_id');
			$this->db->runQuery($query);
		}
		
	}
	
	
	/**
	 * 조직 구성원 순서 변경
	 * @param unknown $post
	 */
	public function memberArrange($post = null){
	
		$column = $this->db->getColumns($this->table, array('org_sort'), true);
		foreach($post['arrange'] as $key => $value){
			
			$data = array();
			$data['org_id'] = $value;
			$data['org_sort'] = $key + 1;
			
			$query = $this->db->updateSql($column, $data, $this->table, 'org_id', 'org_id');
			$this->db->runQuery($query);
		}
		
	}
	
	
	
	
	
	
	

	
	
	
	
	/**
	 * 삭제 여부 체크
	 * @param number $no
	 * @return boolean 0 : 삭제 할 수 있음. , 1 : 삭제 할 수 없음(하위 부서 존재), 2 : 삭제 할 수 없음 (구성원 존재)
	 */
	private function deleteCheck($no = 0){
		
		$delete = 0;
		
		//삭제할 부서에 등록된 하위부서나 구성원이 있는지 체크
		$query = "SELECT count(*) FROM ".$this->table." WHERE org_parent = ".$no;
		$dbData = $this->db->getDBData($query);
		
		if(intval($dbData[0][0]) > 0){
		
			$query = "SELECT org_type FROM ".$this->table. " WHERE org_parent = ".$no." ORDER BY org_id DESC LIMIT 1";
			$dbData = $this->db->getDBData($query);
			$org_type = $dbData[0]['org_type'];
			if($org_type == 'team'){
				$delete = 1;
			}else if($org_type == "member"){
				$delete = 2;
			}
		}
		
		
		return $delete;
	}
	
	
	
	/**
	 * 삭제
	 * @param number $no
	 */
	public function delete($no = 0){
		
		$delete = $this->deleteCheck($no);
		
		if($delete == 1){
			alert('등록된 하위부서가 있어서 삭제 할 수 없습니다.');
		}else if($delete == 2){
			alert('등록된  구성원이 있어서 삭제 할 수 없습니다.');
		}
		
		$query = "DELETE FROM ".$this->table." WHERE org_id = ".$no;
		$this->db->runQuery($query);
		
	}
	
	
	
	public function findParentData($id = 0){
	    if(intval($id) > 0){
	        $query = "SELECT * FROM ".$this->table." WHERE org_id = ".$id;
	        $menuData = $this->db->getDBData($query);
	        return $menuData[0];
	    }else {
	        return null;
	    }
	}
	
	
	/**
	 * 상위 계층 구조를 찾아줌.
	 * @param number $id
	 * @return array
	 */
	public function getPositionArray($id = 0){
	    
	    $position = array();
	    
	    $repeat = 0;
	    while($id){
	        
	        if($repeat >= 10) break; //무한 루프 방지
	        $data = $this->findParentData($id);
	        $id = intval($data['org_parent']);
	        array_push($position, $data);
	        
	        $repeat++;
	    }
	    
	    return $position;
	}
	
	
	/**
	 * 팀(부서)명을 리턴함.
	 * @param number $id
	 * @return unknown
	 */
	public function getTeamName($id = 0){
	    $query = "SELECT org_name FROM ".$this->table." WHERE org_id = ".$id;
	    $dbData = $this->db->getDBData($query);
	    return $dbData[0]['org_name'];
	}
	
	/**
	 * 팀(부서)명을 계층 구조로 표시 
	 * @param number $id
	 * @return string
	 */
	public function getTeamNameAll($id = 0){
	    $html = "";
	    
	    $position = $this->getPositionArray($id);
	    if($position != null){
	        
	        for($i = count($position) - 1; $i >= 0; $i--){
	            $id = $position[$i]['org_id'];
	            $html .= $this->getTeamName($id);
	            
	            if($i != 0) $html .= " &gt; ";
	        }
	    }
	    
	    return $html;
	}
	
	
	
	/**
	 * 메뉴 등록,수정시 상위 메뉴를 선택 할 수 있게 select 태그안의 option 리스트를 뿌려줌.
	 * @param int $id (메뉴코드값)
	 * @param int $depth (메뉴차수)
	 * @param int $update_mode_menuid (수정모드시 DB에 저장된 메뉴코드값)
	 */
	public function getMenuOption($id, $depth, $siteName = null, $update_mode_menuid = null)
	{
		$query = "SELECT * FROM ".MENU_TABLE." WHERE site = '{$siteName}' AND parent_id = {$id} and rank = {$depth} ORDER BY menu_order ASC";
		$dbData = $this->db->getDBData($query);
		$total = count($dbData);
	
		if($total > 0)
		{
			for($i = 0; $i < count($dbData); $i++)
			{
				if($update_mode_menuid) $selected = isselected($update_mode_menuid, $dbData[$i]['menu_id']);
				else $selected = "";
	
				$id = $dbData[$i]['menu_id'];
				$depth = $dbData[$i]['rank'] + 1;
				echo "<option value=\"{$dbData[$i]['menu_id']}\" {$selected}>".str_repeat("&nbsp;&nbsp;&nbsp;", $depth - 1).$dbData[$i]['menu_title']."</option>";
				$this->getMenuOption($id, $depth, $siteName, $update_mode_menuid);
			}
		}
	}
	
	
	public function teamMenuModify($post = null){
		
		$no = intval($post['no']);
		$menu_id = intval($post['menu_id']);
		$query = "UPDATE ".$this->table." SET menu_id = ".$menu_id." WHERE org_id = ".$no;
		$this->db->runQuery($query);
	}
	
	
	public function getMenuHierarchy($id = 0)
	{
		$text = '';

		$i = 0;
		while($id){
			if($i >= 9) break;
			$query = "SELECT parent_id, menu_title FROM ".MENU_TABLE." WHERE menu_id = ".$id;
			$data = $this->db->getDBData($query);
			
			$title = $data[0]['menu_title'];
			$parent = $data[0]['parent_id'];
			$id = $parent;
			$separate = $i == 0 ? "" : " > ";
			$text = $data[0]['menu_title'].$separate.$text ;
			
			$i++;
		}
		
		return $text;
	}
	
}


