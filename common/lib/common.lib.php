<?php 
    
    function setLinkTag($cssfile = null){
        if($cssfile){
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssfile."\" />".PHP_EOL;
        }
    }
    
    function setScriptTag($jsfile = null){
        if($jsfile){
            echo "<script src=\"".$jsfile."\"></script>".PHP_EOL;
        }
    }
    
    function setLinkTagArray($array = null){
    	if(isset($array) && $array != null)
    	{
	    	foreach($array as $value){
	    		setLinkTag($value);
	    	}
    	}
    }
    
    function setScriptTagArray($array = null){
    	if(isset($array) && $array != null)
    	{
	    	foreach($array as $value){
	    		setScriptTag($value);
	    	}
    	}
    }
    
    function getLoginMenuID(){
    	global $DB;
    	$query = "SELECT menu_id FROM ".MENU_TABLE." WHERE route = 'login' AND site = '".SITE_NAME."'";
    	$dbData = $DB->getDBData($query);
    	return $dbData[0]['menu_id'];
    }
 
    function findRouteMenuID($route = '', $site = ''){
        global $DB;
        if($site == '') $site = SITE_NAME;
        $query = "SELECT menu_id FROM ".MENU_TABLE." WHERE route = '{$route}' AND site = '".$site."'";
        $dbData = $DB->getDBData($query);
        return $dbData[0]['menu_id'];
    }
    
    //210112
    function getContentsList($menu_id = 0){
    	global $DB;
    	$query = "SELECT content_id, contents, writetime FROM ".CONTENTS_TABLE." WHERE menu_id = {$menu_id} ORDER BY content_id DESC";
    	$dbData = $DB->getDBData($query);
        //$contentslist = count($dbData) > 0 ? htmlspecialchars_decode($dbData[0]['contents']) : "";
    	return $dbData;
    }
    
    function getPageFile($data = null){
        
        $page_file = "";
        if($data != null){
            $menu_type = trim($data['menu_type']);
            
            if($menu_type == "skin"){
                $page_file = BASE_PATH."/".SITE_NAME."/skin/".trim($data['skin_group'])."/".trim($data['skin'])."/index.php";
                
            }else if($menu_type == "contents"){
                $page_file = BASE_PATH."/".SITE_NAME."/config/contents.php";
            }
            
        }
        return $page_file;

    }
    
    
    function getBackUrl($string, $isPhp = false){
    
    	
        $url = ($isPhp == true) ? urlencode("../../../?") : "./?";
        $stringDiv = explode("|", $string);
        $j = 0;
    
        for($i = 0; $i < count($stringDiv); $i++){
            $name = $stringDiv[$i];
            $value = isset($_GET[$name]) ? trim($_GET[$name]) : null;
    
            if($value != null){
                if($j == 0){
                    $url .= $name."=".urlencode($value);
                }else{
                    if($isPhp == true)
                        $url .= "&".$name."=".urlencode($value);	// php 파일에서 header 이동용으로 사용하기 위함 : 사용법은 콤마와 0 이 아닌 숫자(예:1)를 넣으면 됨
                    else
                        $url .= "&amp;".$name."=".urlencode($value);	// 일반 a href 링크에 사용되는 링크 생성용
                }
                $j++;
            }
    
        }
    
        return $url;
    }
    
    
    
    function alert($msg = '', $url = '')
    {
    
    	global $system;
    	include BASE_PATH."/".SITE_NAME."/config/siteinfo.php";
    	 
    	$msg = trim($msg);
    	$author = $system['site']['author'];
    	$keyword = $system['site']['keyword'];
    	$body = ""; 
    	 
        if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
    
        $body .= "<script type=\"text/javascript\">alert('{$msg}');";
        if (!$url) {
        	$body .= "history.go(-1);";
        }else{
        	$body .= "location.replace('$url');";
        }
        $body .= "</script>";
        
        $html = file_get_contents(COMMON_PATH."html/default.html");
        $html = str_replace("{author}", $author, $html);
        $html = str_replace("{keyword}", $keyword, $html);
        $html = str_replace("{body}", $body, $html);
        
        echo $html;
        exit;
        
    }
    
    /**
     * 
     * @param unknown $blank_array
     * 
     * 필수 입력 항목 체크 함수
     * array("uid|아이디를", "upw|비밀번호를", "!gender|성별을") 형태로 파라미터를 전달  
     * 각 배열 요소의 첫글자에 !가 있으면 선택해 주세요 메시지를 출력함.(checkbox, radio, select 요소에 사용)
     */
	function blankCheck($blank_array = null){
        
		if($blank_array != null)
		{
			foreach($blank_array as $string){
                
				$tmp = explode("|", $string);
				$name_tmp = trim($tmp[0]);
				$name_txt = trim($tmp[1]);
				$name_type = substr($name_tmp, 0, 1);
				$name = str_replace("!", "", $name_tmp);
               
				$empty = false;
				$_REQUEST[$name] = isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
				$is_array = is_array($_REQUEST[$name]);
              
				if($is_array){
					if(count($_REQUEST[$name]) == 0){
						$empty = true;
					}
				}else{
               	
					if(trim($_REQUEST[$name]) == "" || trim($_REQUEST[$name]) == null){
						$empty = true;
					}
				}
				$msg = "";
               
				if($empty){
                   
					if($name_type == "!"){
						$msg = $name_txt." 선택해 주세요";
					}else{
						$msg = $name_txt." 입력해 주세요";
					}
				}
               
				if($msg != "") alert($msg);
            }
        }
    }
    
    
    function getSiteList(){
        $dir = BASE_PATH;
        $site_data = array();
        $d = dir($dir);
        while ($entry = $d->read()) {
            
            if ($entry != '.' && $entry != '..') {
                $_path = $dir."/".$entry;
                if(is_dir($_path)){
                    if(file_exists($_path."/config/siteinfo.php")){
                    	include BASE_PATH."/".$entry."/config/siteinfo.php";
                    	$site_data[$entry] = $system['site'];
                    }
                    
                }
            }
        }
        arsort($site_data);
        return $site_data;
    }
    
    
    function isselected($value1, $value2){
    	
    	return trim($value1) == trim($value2) ? "selected=\"selected\"" : "";
    
    }
    
    function ischecked($value1, $value2){
       
    	return trim($value1) == trim($value2) ? "checked=\"checked\"" : "";
    
    }
    
    
    function fileSizeTxtToByte($txt = '') {
    	
    	$units = array('B', 'KB', 'MB', 'GB', 'TB');
    	$units2 = array('B', 'K', 'M', 'G', 'T');
    	
    	$value = intval($txt);
    	preg_match('/[a-z]+/i', $txt, $match);
    	$unit = isset($match) && count($match) > 0 ? $match[0] : "";
        
        $size = 0;
        
   
        
        if(in_array($unit, $units) || in_array($unit, $units2)){
            for($i = 0; $i < count($units); $i++){
                if($units[$i] == $unit || $units2[$i] == $unit){
                    $unitValue = pow(1024, $i);
                    break;
                }
            }
            $size = intval($value) * $unitValue;
        }
        
        return $size;
    }

    
    function fileSizeByteToTxt($size) {
        
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++)
        {
            $size /= 1024;
        }
        
        return  round($size, 2).$units[$i];
        
    }
    
    
    function randomString($length) {
    	$randCode = array('1','2','3','4','5','6','7','8','9','0','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    	$Rstring = "";
    	mt_srand((double)microtime() * 1000000);
    	for($i = 1;$i <= $length; $i++) {
    		$Rstring .= $randCode[mt_rand(1, count($randCode) - 1)];
    
    	}
    	return $Rstring;
    }
    

    function strcut($str = '', $len = 30)
    {
    	$str = htmlspecialchars_decode(trim($str), ENT_QUOTES);	// 텍스트만 잘라내므로 필요없는 테그 등은 모두 삭제한 상태에서 잘라낸다.
    	$str = str_replace("&nbsp;", "", $str);
    	$str = strip_tags($str);
    	$newText = $str;
    	$_len = 0;
    	$_txt = "";
    
    	for($i = 0; $i < strlen($newText); $i++){
    		$tmp = mb_substr($newText, $i, 1, "utf-8");
    		if(strlen($tmp) > 1){
    			$tmpType = 2;
    			$_len += 2;
    		}else{
    			$tmpType = 1;
    			$_len += 1;
    		}
    			
    		if($len > $_len)
    			$_txt .= $tmp;
    			else
    				break;
    	}
    
    	if(strlen($newText) > strlen($_txt))
    		$_txt .= "..";
    		return $_txt;
    }
    
    
    
    function strcut_for_keyword($str, $keyword, $len = 30)
    {
    	$str = htmlspecialchars_decode(trim($str), ENT_QUOTES);	// 텍스트만 잘라내므로 필요없는 테그 등은 모두 삭제한 상태에서 잘라낸다.
    	$str = str_replace("&nbsp;", "", $str);
    	$str = strip_tags($str);
    	
    	$_txt = "";
    	$start = 0;
    	$textlength = mb_strlen($str);
    	if($keyword != "")
    	{
    		$pos = mb_strpos($str, $keyword);
    		if($pos) $start = $pos;
    
    		//keyword가 문장 끝부분에 있어서 가져올 내용이 적다면..
    		if($pos + $len > $textlength)
    		{
    			$start = intval($pos - $len / 2);
    			if($start < 0) $start = 0;
    
    			$len = $textlength;
    
    		}else
    		{
    			$start = $pos - $len / 2;
    			if($start < 0) $start = 0;
    		}
    
    
    		$_txt = mb_substr($str, $start, $len, "utf-8");
    		$_accent = "<span style=\"color: #bd0c62; font-weight: bold; text-decoration: underline\">".$keyword."</span>";
    		$_txt = str_replace($keyword, $_accent, $_txt);
    		if($pos + $len < $textlength)
    		{
    			$_txt .= "..";
    		}
    
    	}else
    	{
    		$_txt = strcut($str, $len);
    	}
    
    
    	return $_txt;
    }
    
    
    function isNew($writedate = null){		
    	$t_value = false;
    
    	$_twritedate =  strtotime($writedate);
    	$t_now = time();
    	$t_yesterday = $t_now - (24 * 3600);	 // 1일 전의 글은 최신글로 함
    
    
    	if($_twritedate >= $t_yesterday)
    		$t_value = true;
    
    		return $t_value;
    
    }
    
    
    function getNewFileName($file_tempName){
    	$tmp = "";
    	$filename = $file_tempName;
    	$tmp.= date("YmdHis");
    	$tmp.= "_".$filename;
    	return $tmp;
    }
    
    
    function getFileIcon($filename){
    
    
    	$hwpArr = array("hwp", "hwt");
    	$pptArr = array("ppt", "pptx",  "pot", "potx");
    	$htmlArr = array("html", "htm");
    	$xlsArr = array("xls", "xlsx", "xlt", "xlsb", "csv");
    	$pdfArr = array("pdf");
    	$gifArr = array("gif", "jpg", "jpeg", "png", "bmp");
    	$swfArr = array("swf", "fla", "flv");
    	$mp3Arr = array("mp3", "wav", "mid", "pcm", "raw", "dbl");
    	$docArr = array("doc", "docx", "dotx", "dot");
    	$zipArr = array("zip", "alz", "rar", "arj");
    	$aviArr = array("avi", "mpg", "mpeg", "asf", "wmv", "flv", "mp4");
    
    	$icon = "file_etc.gif";
    
    	$ext = getFileExtention($filename);
    	if($ext !=""){
    		if(in_array($ext, $hwpArr))
				$icon = "file_hwp.gif";
			else if(in_array($ext, $pptArr))
				$icon = "file_ppt.gif";
			else if(in_array($ext, $htmlArr))
				$icon = "file_html.gif";
			else if(in_array($ext, $xlsArr))
				$icon = "file_xls.gif";
			else if(in_array($ext, $pdfArr))
				$icon = "file_pdf.gif";
			else if(in_array($ext, $gifArr))
				$icon = "file_gif.gif";
			else if(in_array($ext, $swfArr))
				$icon = "file_swf.gif";
			else if(in_array($ext, $mp3Arr))
				$icon = "file_mp3.gif";
			else if(in_array($ext, $docArr))
				$icon = "file_doc.gif";
			else if(in_array($ext, $zipArr))
				$icon = "file_zip.gif";
			else if(in_array($ext, $aviArr))
				$icon = "file_avi.gif";
			else
				$icon = "file_etc.gif";
    
    	}
    
    	$iconData['icon'] = $icon;
    	$iconData['ext'] = $ext;
    
    
    	return $iconData;
    
    }
    
    function getFileExtention($filename){
    	$ext = "";
    	$tmpDiv = explode(".", $filename);
    	$ext = $tmpDiv[count($tmpDiv)-1];
    	return strtolower($ext);
    }
    
    
    function getPasswordPageBackUrl($url = ''){
    	
    	$url = str_replace("&amp;", "&", $url);
    	
    	if(preg_match("/&mode=view/i", $url)){
    		
    		$patterns[0] = "/&mode=view/i";
    		$patterns[1] = "/&no=[0-9]+/i";
    		$replacements[0] = "&mode=list";
    		$replacements[1] = "";
    		$url = preg_replace($patterns, $replacements, $url);
    	}else if(preg_match("/&mode=update/i", $url)){
    		$pattern = "/&mode=update/i";
    		$replacement = "&mode=view";
    		$url = preg_replace($pattern, $replacement, $url);
    	}
    	
    	return $url;
    }
    
    
    function is_mobile()
    {
    	return preg_match('/phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|BB10|android|sony/i', $_SERVER['HTTP_USER_AGENT']);
    }    
    
    
    function make_table($tablename = '', $menutitle = ''){
        
        global $DB;
        $tablename = "inner_".trim($tablename);
        
        $table_check = false;
        
        while(!$table_check){
            $query = "SHOW TABLE STATUS LIKE '$tablename'";
            $dbData = $DB->getDBData($query);
            if(count($dbData) > 0){
                $tablename = $tablename."_copy";
            }else{
                $table_check = true;
            }
            
        }
        
        
        $file = file_get_contents(COMMON_PATH."sql/dbtable.sql");
        $sql = str_replace("{tableName}", $tablename, $file);
        $sql = str_replace("{menuTitle}", $menutitle, $sql);
        
        $DB->runQuery($sql);
        return $tablename;
    }
    
    
    function getGroupName($authlevel = 0){
    	global $DB;
    	
    	if($authlevel == 0) return null;
    	$query = "SELECT name FROM ".GROUP_TABLE." WHERE authlevel = ".$authlevel;
    	$dbData = $DB->getDBData($query);
    	return trim($dbData[0]['name']);
    }
    
    
    
    // 쿠키변수 생성
    function set_cookie($cookie_name, $value, $expire)
    {
    	global $g5;
    	setcookie(md5($cookie_name), base64_encode($value), time() + $expire, '/');
    }
    
    
    // 쿠키변수값 얻음
    function get_cookie($cookie_name)
    {
    	$cookie = md5($cookie_name);
    	if (array_key_exists($cookie, $_COOKIE))
    		return base64_decode($_COOKIE[$cookie]);
		else
			return "";
    }
    
    
 
    // get_browser() 함수는 이미 있음
    function get_brow($agent)
    {
    	$agent = strtolower($agent);
    
    	//echo $agent; echo "<br/>";
    
    	if (preg_match("/msie ([1-9][0-9]\.[0-9]+)/", $agent, $m)) { $s = 'MSIE '.$m[1]; }
    	else if(preg_match("/firefox/", $agent))            { $s = "FireFox"; }
    	else if(preg_match("/chrome/", $agent))             { $s = "Chrome"; }
    	else if(preg_match("/x11/", $agent))                { $s = "Netscape"; }
    	else if(preg_match("/opera/", $agent))              { $s = "Opera"; }
    	else if(preg_match("/gec/", $agent))                { $s = "Gecko"; }
    	else if(preg_match("/bot|slurp/", $agent))          { $s = "Robot"; }
    	else if(preg_match("/internet explorer/", $agent))  { $s = "IE"; }
    	else if(preg_match("/mozilla/", $agent))            { $s = "Mozilla"; }
    	else { $s = "기타"; }
    
    	return $s;
    }
    
    function get_os($agent)
    {
    	$agent = strtolower($agent);
    
    	//echo $agent; echo "<br/>";
    
    	if (preg_match("/windows 98/", $agent))                 { $s = "98"; }
    	else if(preg_match("/windows 95/", $agent))             { $s = "95"; }
    	else if(preg_match("/windows nt 4\.[0-9]*/", $agent))   { $s = "NT"; }
    	else if(preg_match("/windows nt 5\.0/", $agent))        { $s = "2000"; }
    	else if(preg_match("/windows nt 5\.1/", $agent))        { $s = "XP"; }
    	else if(preg_match("/windows nt 5\.2/", $agent))        { $s = "2003"; }
    	else if(preg_match("/windows nt 6\.0/", $agent))        { $s = "Vista"; }
    	else if(preg_match("/windows nt 6\.1/", $agent))        { $s = "Windows7"; }
    	else if(preg_match("/windows nt 6\.2/", $agent))        { $s = "Windows8"; }
    	else if(preg_match("/windows 9x/", $agent))             { $s = "ME"; }
    	else if(preg_match("/windows ce/", $agent))             { $s = "CE"; }
    	else if(preg_match("/mac/", $agent))                    { $s = "MAC"; }
    	else if(preg_match("/linux/", $agent))                  { $s = "Linux"; }
    	else if(preg_match("/sunos/", $agent))                  { $s = "sunOS"; }
    	else if(preg_match("/irix/", $agent))                   { $s = "IRIX"; }
    	else if(preg_match("/phone/", $agent))                  { $s = "Phone"; }
    	else if(preg_match("/bot|slurp/", $agent))              { $s = "Robot"; }
    	else if(preg_match("/internet explorer/", $agent))      { $s = "IE"; }
    	else if(preg_match("/mozilla/", $agent))                { $s = "Mozilla"; }
    	else { $s = "기타"; }
    
    	return $s;
    }
    
    
    function term_check($date1 = '', $date2 = ''){
    	
    	if($date1 != "" && $date2 != ""){
    		if($date1 > $date2) alert('기간이 잘못되었습니다.');
    	}
    }
    
    
    function dateDisplay($date1 = '', $date2 = ''){
    	
    	$date = "";
    	if($date1 != "" && $date1 != "0000-00-00"){
    		$date = $date1;
    	}
    	
    	if($date2 != "" && $date2 != "0000-00-00"){
    		$date .= " ~ ". $date2;
    	}
    	
    	
    	return $date;
    }
    
    
    function getDday($date){
    
    	$dday = 0;
    	$now = strtotime(TIME_YMD);
    	$d_time = strtotime($date);
    	$minus = false;
    
    	$time_interval = $d_time - $now;
    	if($time_interval < 0) $minus = true;
    
    	$day = floor(abs($time_interval) / (60 * 60 * 24));
    	if($minus && $day > 0) $dday = "-".$day;
    	else $dday = $day;
    
    	return $dday;
    }

    
    function getFileData($no = 0, $type = 'files'){
    	global $DB;
    	$query = "SELECT * FROM ".FILE_TABLE." WHERE indexcode = $no AND attach_type = '$type'";
    	$dbData = $DB->getDBData($query);
    	return $dbData;
    }
    
    function replace_text($text, $length=1, $entity="*"){
        $tmp = "";
        $return_text = "";
        $text_length = mb_strlen($text,"utf-8");
        for($i=0;$i<$text_length;$i++){
            $tmp = mb_substr($text,$i,1,"utf-8");
            if($i < ($length) ) $return_text .= $tmp;
            else $return_text .= $entity;
        }
        
        return $return_text;
    }
    
    function spamCheck($memo = ''){
    	include_once COMMON_PATH."/conf/spam.php";
    	$spamData = explode(",", SPAM_WORD);
    	
    	$check['isok'] = true;
    	$check['word'] = "";
    	
    	foreach($spamData as $value){
    		$pattern = "/".$value."/i";
    		preg_match($pattern, $memo, $matches, PREG_OFFSET_CAPTURE);
    		
    		if(isset($matches[0][0]) && trim($matches[0][0]) != ""){
    			$check['isok'] = false;
    			$check['word'] = $matches[0][0];
    			break;
    		}
    	}
    	
    	return $check;
    }
    
    
    function autolink($data)
    {
        $data = html_entity_decode($data);
        // http
        $data = preg_replace("/http:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" target='_blank'>http://\\1</a>", $data);
        
        // https
        $data = preg_replace("/https:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" target='_blank'>http://\\1</a>", $data);
        
        // ftp
        $data = preg_replace("/ftp:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"ftp://\\1\" target='_blank'>ftp://\\1</a>", $data);
        
        // email
        $data = preg_replace("/([_0-9a-z-]+(\.[_0-9a-z-]+)*)@([0-9a-z-]+(\.[0-9a-z-]+)*)/i", "<a href=\"mailto:\\1@\\3\">\\1@\\3</a>", $data);
        
        return $data;
    }
    
    function removeAnnotation($text = ''){
        return preg_replace('/<!--(.*?)-->/is', '', $text);
    }
    
    include_once "banner.lib.php";
    include_once "youtube.lib.php";
  