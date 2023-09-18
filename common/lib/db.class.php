<?php 
class DB extends mysqli {
	
	public $dbInfo;
	
	private $host = "";
	private $id = "";
	private $pw = "";
	private $dbname = "";
	
	public function __construct($host = '', $id = '', $pw = '', $dbname = ''){
		
		if($host == '') $host = $this->host;
		if($id == '') $id = $this->id;
		if($pw == '') $pw = $this->pw;
		if($dbname == '') $dbname = $this->dbname;
		
		if(!$host || !$id || !$pw || !$dbname) die('DB 접속 정보가 잘못되었습니다. common/conf/db.class.php 파일에서 DB 접속 정보를 입력해 주세요.');
		parent::__construct($host, $id, $pw, $dbname);
		
	    $this->dbInfo = $this;
	    if($this->connect_errno) die('DB접속 오류');
		mysqli_query($this->dbInfo, "SET NAMES 'utf8'");
		
	}
	
	
	
	public function getDBData($query, $assoc = MYSQL_BOTH){
		
		$data = array();
		$result = mysqli_query($this->dbInfo, $query);
	
		//MYSQL_NUM, MYSQL_ASSOC, MYSQL_BOTH
		if($result != null){
			$i = 0;
			while($row = mysqli_fetch_array($result, $assoc)){
	
				$data[$i] = $row;
				$i++;
			}
				
	
		}else 
		{
			echo "query wrong ( ".$query. " ) ";
			$data = null;
		}
	
		return $data;
	
	}
	
	
	public function runQuery($query = null){
	    if($query != ""){
			$result = mysqli_query($this->dbInfo, $query);
			if($result == null){
			    if(ENVIRONMENT != 'production'){
			     echo "<p> wrong query ( ".$query." )</p>";
			    }
			}
			return $result;
	    }
	}
	
	
	
	
    public function whereSql($string, $whereflag = true){

        $stringDiv = explode("|", $string);
        $j = 0;

        if($whereflag)
            $where = " WHERE ";
        else
            $where = " AND ";
		
		  
        for($i = 0; $i < count($stringDiv); $i++){
            $name_tmp = $stringDiv[$i];
            $name_type = substr($name_tmp, 0, 1);
            if($name_type == "!"){
                $type = "number";
            }else if($name_type == "%"){
                $type = "like";
            }else if($name_type == "#"){
                $type = "password";
            }else{
                $type= "string";
            }
            
            $name = str_replace(array("!", "#", "%"), "", $name_tmp);
            
            if(isset($_POST[$name])){
                $value = trim($_POST[$name]);
            }else if(isset($_GET[$name])){
                $value = trim($_GET[$name]);
            }else {
                $value = "";
            }
            
            $value = htmlspecialchars(mysqli_real_escape_string($this->dbInfo, $value), ENT_QUOTES);
		  
            if($value != null){
                
                if($j > 0){
                    $where .= " AND ";
                }
                
                if($type == "number"){
                    $where .= $name."=".$value;
                }else if($type == "like"){
                    $where .= $name." LIKE '%".$value."%' ";
                }else if($type == "password"){
                    $where .= $name." =  password('".$value."') ";
                }else{
                    $where .= $name." = '".$value."' ";
                }
                $j++;
		      }
		  }
		  
		  if($j == 0) $where = "";
		  
		  return $where;
		  
	}
	
	
	
	/**
	 *
	 * @param string $table 테이블명
	 * @param array $cols 컬럼명 배열
	 * @param boolean $reverse reserver값이 false일 경우 $cols에 포함된 컬럼을 제외하고 가져오지만 true 일경우 $cols에 포함된 컬럼만 가져옴.
	 * 테이블의 컬럼을 조회
	 */
	public function getColumns($table = '', $cols = array(), $reverse = false){
	
	    $columns = array();
	    if($table == ""){
	        die('not table');
	    }else{
	        $query = "SHOW COLUMNS FROM $table";
	        $dbData = $this->getDBData($query);
	         
	        foreach($dbData as $row){
	        	
	        	if($reverse)
	        	{
	        		if(in_array($row['Field'], $cols))
	        		{
	        			$columns[$row['Field']] = array('dataType' => $row['Type']);
	        		}
	        		
	        	}else{
		            if(!in_array($row['Field'], $cols))
		            {
	    	            $columns[$row['Field']] = array('dataType' => $row['Type']);
		            }
	        	}
	        }
	    }
	
	    return $columns;
	
	}
	
	
	private function getFieldType($field_type = null, $field_data_type = null){
		
		$type = '';
		
		if($field_type != ""){
			$type = $field_type;
		}else{
			if(strpos(strtolower($field_data_type), 'int') !== false){
				$type = "number";
			}else if(
			    strpos(strtolower($field_data_type), 'char') !== false ||
			    strpos(strtolower($field_data_type), 'varchar') !== false ||
			    strpos(strtolower($field_data_type), 'text') !== false ||
			    strpos(strtolower($field_data_type), 'date') !== false ||
			    strpos(strtolower($field_data_type), 'time') !== false ||
			    strpos(strtolower($field_data_type), 'datetime') !== false ||
			    strpos(strtolower($field_data_type), 'enum') !== false
				){
					$type = "string";
			}else {
			    $type = $field_data_type;
			}
		}
		return $type;
	}
	
	
	private function makeSetSql($type = '', $field ='',  $value = null){
		
		$sql = "`$field` = ";
		
		if($type == "number"){
			$sql .= intval($value);
		}else if($type == "string"){
		    $sql .= "'".htmlspecialchars($value, ENT_QUOTES)."'";
		}else if($type == "password"){
			$sql .= " password('".$value."')";
		}else if($type == "date"){
		    $value = $value ? $value : "0000-00-00";
			$sql .= " '".$value."'";
		}else if($type == "time"){
		    $value = $value ? $value : "00:00:00";
			$sql .= " '".$value."'";
		}else if($type == "datetime"){
		    $value = $value ? $value : "0000-00-00 00:00:00";
			$sql .= " '".$value."'";
		}else if($type == "base64"){
			$sql .= "'".base64_encode($value)."'";
		}else if($type == "now"){
			$sql .= "now()";
		}else{
			
		}
		return $sql;
	}
	
	
	
	public function updateSql($column = null, $postValue = null, $table = '', $where_col = 'indexcode'){
	
	    if($table == '') return null;
	    
	    
	    $sql = "UPDATE ".$table." SET ";
	    $sql2 = '';
	    $sql3 = '';
	    $comma = ", ";
	    $i = 0;
	    
	    foreach($column as $field => $field_type){
	        
	        $fieldDataType = isset($field_type['dataType']) && trim($field_type['dataType']) != "" ? $field_type['dataType']: null;
	        $fieldType = isset($field_type['type']) && trim($field_type['type']) != "" ? $field_type['type']: null;
	        $type = $this->getFieldType($fieldType, $fieldDataType);
	        
            if($field != $where_col)
            {
    	        //type ( number, string, password, base64, now )
                $value = isset($postValue[$field]) ? trim($postValue[$field]) : null;
                
                
				$comma_add = false;
				$set_sql = $this->makeSetSql($type, $field, $value);
				if($sql2 != "" && $set_sql != "") $comma_add = true;
				if($set_sql == "") $comma_add = false; 
	               
				if($comma_add) $sql2 .= $comma;
				$sql2 .= $set_sql;
				$i++;
	        }
	        
	        
	    }
	    
	    $where_val = trim($postValue[$where_col]);
	    $sql3 = " WHERE ".$where_col." = '".$where_val."'";
	    
        $query = $sql.$sql2.$sql3;
        if($sql2 == "") $query = "";
	    return $query;
	
	}
	
	public function insertSql($column = null, $postValue = null, $table = ''){
	
	    if($table == '') return null;
	    
	    
	    $sql = "INSERT INTO ".$table." SET ";
		$sql2 = "";
		$comma = ", ";
	    $i = 0;
	    foreach($column as $field => $field_type){
	        
	        $fieldDataType = $field_type['dataType'];
	        
	        $fieldDataType = isset($field_type['dataType']) && trim($field_type['dataType']) != "" ? $field_type['dataType']: null;
	        $fieldType = isset($field_type['type']) && trim($field_type['type']) != "" ? $field_type['type']: null;
	        $type = $this->getFieldType($fieldType, $fieldDataType);
	         
    	    //type ( number, string, password, base64, now )
            $value = isset($postValue[$field]) ? addslashes($postValue[$field]) : null;
			
			$comma_add = false;
			$set_sql = $this->makeSetSql($type, $field, $value);
			if($sql2 != "" && $set_sql != "") $comma_add = true;
			if($set_sql == "") $comma_add = false; 
               
			if($comma_add) $sql2 .= $comma;
			$sql2 .= $set_sql;
			$i++;
      
	        
	    }
	    
	    
        $query = $sql.$sql2;
        if($sql2 == "") $query = "";
	    return $query;
	
	}
	
	
	public function tableExists($tableName = ''){
		if($tableName == '') return false;
		
		$query = "SHOW TABLES LIKE '".$tableName."'";
		$dbData = $this->getDBData($query);
		
		return count($dbData) > 0 ? true : false;
	}
	
	
	public function install_check(){
		$check = $this->tableExists(MENU_TABLE);
		
		if(!$check){
			die('사이트 구성에 필요한 테이블이 설치되어 있지 않습니다. <a href="install.php">설치</a>를 클릭하면 설치를 진행합니다.');
		}
	}
	
	public function install(){
		
		$fp = fopen(COMMON_PATH."sql/install.sql", "r");
		$text = "";
		while (!feof($fp)) {
			$text .= fread($fp,1024);
		}
		fclose($fp);
		
		mysqli_multi_query($this->dbInfo, $text);
		while ($this->dbInfo->next_result());		//mysqli_multi_query 실행 후 mysqli_query가 실행되지 않음.
		
	}
}
