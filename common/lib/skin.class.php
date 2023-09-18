<?php
class skin {
    
    var $isAdmin;						//관리자 여부
    var $tableName;						//게시판 테이블명
    var $thumbnailWidth = 150;			//섬네일 가로 사이즈
    var $thumbnailHeight = 150;			//섬네일 세로 사이즈
    var $limitFileSizeTxt = "";			//파일 업로드 용량 제한 단위 ( ex : 10MB)
    var $limitFileSize = 0;				//파일 업로드 용량 제한 값
    var $uploadExt = array();			//업로드 가능 확장자
    var $subjectLimitNum = 100;			//제목 길이 제한
    var $listLimitNum = 10;				//페이지당 게시물 수
    var $categoryUse = false;			//카테고리 사용여부
    var $categoryList = null;			//카테고리 리스트
    var $skinHeader = null;				//스킨 상단디자인
    var $skinTail = null;				//스킨 하단디자인
    var $auth_list = 0;					//리스트 보기 권한
    var $auth_view =  0;				//뷰페이지 보기 권한
    var $auth_write = 0;				//글쓰기 권한
    var $auth_comment =  0;				//코멘트 쓰기 권한
    var $auth_reply =  0;				//답글 쓰기 권한
    var $auth_alltag = 0;				//모든태그 사용 권한
    var $auth_gongji = 0;				//공지사항 작성 권한
    var $auth_secret =  0;				//비밀글 작성 권한
    var $auth_fileup = 0;				//파일 업로드 권한
    var $auth_filedown =  0;			//파일 다운로드 권한
    var $auth_admin =  0;				//관리자 기능 사용 권한
    var $skin_path = '';				//스킨 경로
    
    public function __construct($data = null){
        
        $this->isAdmin = isset($_SESSION['user_level']) && $_SESSION['user_level'] != 0 && $_SESSION['user_level'] >= 90 ? true : false;
        $this->tableName = isset($data['db_table']) && trim($data['db_table']) != "" ? trim($data['db_table']) : "";
        $this->tableName2 = isset($data['db_table2']) && trim($data['db_table2']) != "" ? trim($data['db_table2']) : "";
        
        $thumbSize = isset($data['thumb_size']) && trim($data['thumb_size']) != "" ? trim($data['thumb_size']) : "150*150";
        $thumbnail_sizeDiv = explode("*", $thumbSize);
        $this->thumbnailWidth = intval($thumbnail_sizeDiv[0]);
        $this->thumbnailHeight = intval($thumbnail_sizeDiv[1]);
        @$this->limitFileSizeTxt = intval($data['upload_size']).trim($data['upload_unit']);
        if($this->isAdmin) $this->limitFileSizeTxt = ini_get("upload_max_filesize");
        $this->limitFileSize =  fileSizeTxtToByte($this->limitFileSizeTxt);
        $this->uploadExt = isset($data['upload_ext']) && trim($data['upload_ext']) != "" ? explode(",", $data['upload_ext']) : explode(",", DEFAULT_UPLOAD_EXT) ;
        $this->subjectLimitNum = isset($data['subject_limit_num']) && intval($data['subject_limit_num']) > 0 ? intval($data['subject_limit_num']) : $this->subjectLimitNum;
        $this->listLimitNum = isset($data['list_limit_num']) && intval($data['list_limit_num']) > 0 ? intval($data['list_limit_num']) : $this->listLimitNum;
        $this->categoryUse = isset($data['category_use']) && intval($data['category_use']) ? true : false;
        $this->commentUse = isset($data['comment_use']) && intval($data['comment_use']) ? true : false;
        
        if($this->categoryUse){
            $categoryList = explode(",", $data['category_list']);
            $this->categoryList = array();
            foreach($categoryList as $key => $value){
                
                if(trim($value) != ""){
                    $this->categoryList[] = trim($value);
                }
            }
        }
        
        @$this->skinHeader = $data['skin_header'] != "" ? htmlspecialchars_decode($data['skin_header']) : "";
        @$this->skinTail = $data['skin_tail'] != "" ? htmlspecialchars_decode($data['skin_tail']) : "";
        @$this->auth_list = intval($data['auth_list']);
        @$this->auth_view = intval($data['auth_view']);
        @$this->auth_write = intval($data['auth_write']);
        @$this->auth_comment = intval($data['auth_comment']);
        @$this->auth_reply = intval($data['auth_reply']);
        @$this->auth_alltag = intval($data['auth_alltag']);
        @$this->auth_gongji = intval($data['auth_gongji']);
        @$this->skin_path = BASE_PATH."/".SITE_NAME."/skin/".$data['skin_group']."/".$data['skin']."/";
        @$this->auth_secret = intval($data['auth_secret']);
        @$this->auth_fileup = intval($data['auth_fileup']);
        @$this->auth_admin = intval($data['auth_admin']);
        @$this->auth_filedown = intval($data['auth_filedown']);
    }
    
    
    
    public function getPaging($pno = 1, $total = 0, $limit_num = 10){
        
        $total = intval($total);
        $page = isset($pno) && intval($pno) > 0 ? intval($pno) : 1;
        $perpagelimit = $limit_num;
        $pagewidthlimit = 10;
        
        $totalpage = floor(($total - 1) / $perpagelimit) + 1;
        
        $pagenumstart = intval($total - ($perpagelimit*($page - 1)));
        $pagewidthstart = (floor(($page - 1) / $pagewidthlimit)) * $pagewidthlimit + 1;
        $pagewidthend = $pagewidthstart + $pagewidthlimit - 1;
        if($pagewidthend > $totalpage)
            $pagewidthend = $totalpage;
            
            $prepage = $pagewidthstart - 1;		 // 이전페이지
            if($prepage <= 0) $prepage = -1;
            
            $nextpage = $pagewidthend + 1;	// 다음페이지
            
            if($nextpage > $totalpage) $nextpage = -1;
            
            $firstpage = 1;									// 처음페이지
            $endpage = $totalpage;				// 마지막페이지
            
            if($total == 0){
                $firstpage = -1;
                $endpage = -1;
                $page = 0;
            }
            
            $listcountnum = $perpagelimit;
            if($page == $endpage) $listcountnum = $pagenumstart;
            
            $paging = array();
            $paging['pagenumstart'] = $pagenumstart;
            $paging['endpage'] = $endpage;
            $paging['firstpage'] = $firstpage;
            $paging['endpage'] = $endpage;
            $paging['prepage'] = $prepage;
            $paging['nextpage'] = $nextpage;
            $paging['pagewidthstart'] = $pagewidthstart;
            $paging['pagewidthend'] = $pagewidthend;
            $paging['pno'] = $page;
            return $paging;
    }
    
    
    public function checkFile($tmpName = '', $pathAndName = ''){
        
        $returnMsg = false;
        
        if(is_uploaded_file($tmpName)){
            
            if(file_exists($pathAndName)){
                alert('동일한 이름을 가진 파일이 존재합니다.');
            }
            
            if(!move_uploaded_file($tmpName, $pathAndName)){
                alert('파일 업로드에 실패했습니다.');
            }
            
            $returnMsg = true;
            
        }else{
            alert("파일이 업로드되지 않았습니다.");
        }
        
        return $returnMsg;
    }
    
    
    public function fileUpload($files = null, $no = 0, $attach_type = 'files'){
        
        global $menuID, $DB;
        $isUpload = false;
        if($files == null || $no == 0) return;
        
        if(is_array($files['tmp_name'])){
            $sfile_tmp_name = $files['tmp_name'];
        }else{
            $sfile_tmp_name[0] = $files['tmp_name'];
        }
        
        if(is_array($files['name'])){
            $sfile_name = $files['name'];
        }else{
            $sfile_name[0] = $files['name'];
        }
        
        if(is_array($files['size'])){
            $sfile_size = $files['size'];
        }else{
            $sfile_size[0] = $files['size'];
        }
        
        $limitFileSize =  $this->limitFileSize;
        $allowFileExt = $this->uploadExt;
        
        for($i = 0; $i < count($sfile_size); $i++)
        {
            
            
            $file_size = intval($sfile_size[$i]);
            
            if($file_size != 0 && ( $file_size <= $limitFileSize))
            {
                $down_file_name = trim($sfile_name[$i]);
                $tmpfileExtDiv = explode(".", $down_file_name);
                $fileExt = strtolower($tmpfileExtDiv[count($tmpfileExtDiv)-1]);
                
                if($fileExt != "php" && in_array($fileExt, $allowFileExt)){
                    $attach_file_name = getNewFileName(rand(10000, 99999).".".$fileExt);	// 업로드후에 바뀔 이름 설정
                    $pathAndName = DATA_PATH."upload/".$attach_file_name;
                    $fileMsg = $this->checkFile($sfile_tmp_name[$i], $pathAndName);
                    
                    
                    if($fileMsg){
                        
                        $data = array();
                        $data['menu_id'] = $menuID;
                        $data['indexcode'] = $no;
                        $data['attach_type'] = $attach_type;
                        $data['attach_file_name'] = $attach_file_name;
                        $data['down_file_name'] = $down_file_name;
                        $data['file_size'] = $file_size;
                        $data['file_ext'] = $fileExt;
                        $data['file_down_count'] = 0;
                        $data['ip'] = $_SERVER['REMOTE_ADDR'];
                        
                        $column = $DB->getColumns(FILE_TABLE, array('file_id'));
                        $column['writetime']['type'] = "now";
                        
                        $query = $DB->insertSql($column, $data, FILE_TABLE);
                        $DB->runQuery($query);
                        $this->Log($query, $menuID);
                        if($DB->affected_rows){
                            $isUpload = true;
                        }
                    }
                }
            }
            
        }
        
        return $isUpload;
    }
    
    
    public function picUpload($files = null, $no = 0, $attach_type = 'thumb', $width = 0, $height = 0){
        
        global $menuID, $DB;
        if($files == null || $no == 0) return;
        
        $file_tmp_name = $files['tmp_name'];
        $file_name = $files['name'];
        $file_size = $files['size'];
        $limitFileSize =  $this->limitFileSize;
        $allowFileExt = array("jpg", "jpeg", "png", "gif", "jfif");
        
        $thumbWidth = $width == 0 ? $this->thumbnailWidth : $width;
        $thumbHeight = $height == 0 ? $this->thumbnailHeight : $height;
        
        
        if($file_size != 0 && ($file_size <= $limitFileSize))
        {
            
            $down_file_name = trim($file_name);
            $tmpfileExtDiv = explode(".", $down_file_name);
            $fileExt = strtolower($tmpfileExtDiv[count($tmpfileExtDiv)-1]);
            
            if($fileExt != "php" && in_array($fileExt, $allowFileExt)){
                
                $attach_file_name = getNewFileName(rand(10000, 99999).".".$fileExt);	// 업로드후에 바뀔 이름 설정
                $file_path = $thumb_path = DATA_PATH."upload/";
                $pathAndName = $file_path.$attach_file_name;
              
                $fileMsg = $this->checkFile($file_tmp_name, $pathAndName);
                
                //기존에 등록된 섬네일 파일 정보를 가져옴.(섬네일 파일은 게시물당 1개씩만 유지)
                $query = "SELECT * FROM ".FILE_TABLE." WHERE menu_id = $menuID AND indexcode = $no AND attach_type = '{$attach_type}'";
                $this->Log($query, $menuID);
                $dbData = $DB->getDBData($query);
                
                
                if($fileMsg){
                    
                    include_once COMMON_PATH."lib/thumbnail.lib.php";
                    
                    
                    $data = array();
                    $data['menu_id'] = $menuID;
                    $data['indexcode'] = $no;
                    $data['attach_type'] = $attach_type;
                    $data['down_file_name'] = $down_file_name;
                    $data['file_size'] = $file_size;
                    $data['file_ext'] = $fileExt;
                    $data['file_down_count'] = 0;
                    $data['ip'] = $_SERVER['REMOTE_ADDR'];
                    $data['attach_file_name'] = makethumbnail($attach_file_name, $file_path, $thumb_path, $thumbWidth, $thumbHeight, "false");
                    $data['file_size'] = filesize($thumb_path.$data['attach_file_name']);
                    
                    
                    $column = $DB->getColumns(FILE_TABLE, array('file_id'));
                    $column['writetime']['type'] = "now";
                    
                    
                    $query = $DB->insertSql($column, $data, FILE_TABLE);
                    $DB->runQuery($query);
                    $this->Log($query, $menuID);
                    
                    if($DB->affected_rows > 0){
                        for($i = 0; $i < count($dbData); $i++){
                            $_file_id = intval($dbData[$i]['file_id']);
                            //$this->fileDelete($_file_id); 기존 섬네일 제거 안함 (다른 게시판의 섬네일이 삭제되는 오류 발생)
                        }
                    }
                    
                    
                }
            }
        }
        
    }
    
    /**
     * 섬네일 생성 함수
     * 원본이미지도 같이 저장
     * 기존 섬네일도 유지
     * @param unknown $files
     * @param number $no
     * @param string $attach_type
     * @param number $width
     * @param number $height
     */
    public function multiPicUpload($files = null, $no = 0, $attach_type = 'thumb', $width = 0, $height = 0){
        
        global $menuID, $DB;
        include_once COMMON_PATH."lib/thumbnail.lib.php";
        
        
        $isUpload = false;
        if($files == null || $no == 0) return;
        
        if(is_array($files['tmp_name'])){
            $sfile_tmp_name = $files['tmp_name'];
        }else{
            $sfile_tmp_name[0] = $files['tmp_name'];
        }
        
        if(is_array($files['name'])){
            $sfile_name = $files['name'];
        }else{
            $sfile_name[0] = $files['name'];
        }
        
        if(is_array($files['size'])){
            $sfile_size = $files['size'];
        }else{
            $sfile_size[0] = $files['size'];
        }
        
        $limitFileSize =  $this->limitFileSize;
        $allowFileExt = $this->uploadExt;
        
        $thumbWidth = $width == 0 ? $this->thumbnailWidth : $width;
        $thumbHeight = $height == 0 ? $this->thumbnailHeight : $height;
        
        for($i = 0; $i < count($sfile_size); $i++)
        {
            
            $file_size = intval($sfile_size[$i]);
            
            if($file_size != 0 && ( $file_size <= $limitFileSize))
            {
                $down_file_name = trim($sfile_name[$i]);
                $tmpfileExtDiv = explode(".", $down_file_name);
                $fileExt = strtolower($tmpfileExtDiv[count($tmpfileExtDiv)-1]);
                
                if($fileExt != "php" && in_array($fileExt, $allowFileExt)){
                    $attach_file_name = getNewFileName(rand(10000, 99999).".".$fileExt);	// 업로드후에 바뀔 이름 설정
                    $file_path = $thumb_path = DATA_PATH."upload/";
                    $pathAndName = DATA_PATH."upload/".$attach_file_name;
                    $fileMsg = $this->checkFile($sfile_tmp_name[$i], $pathAndName);
                    
                    
                    
                    if($fileMsg){
                        
                        $data = array();
                        $data['menu_id'] = $menuID;
                        $data['indexcode'] = $no;
                        $data['attach_type'] = $attach_type;
                        $data['attach_file_name'] = $attach_file_name;  //파일명은 원본 이미지 파일명을 저장
                        $data['down_file_name'] = $down_file_name;
                        $data['file_size'] = $file_size;                //파일 크기도 원본 이미지  파일크기를 저장
                        $data['file_ext'] = $fileExt;
                        $data['file_down_count'] = 0;
                        $data['ip'] = $_SERVER['REMOTE_ADDR'];
                        
                        makethumbnail($attach_file_name, $file_path, $thumb_path, $thumbWidth, $thumbHeight, "false");  //섬네일 생성
                        
                        
                        $column = $DB->getColumns(FILE_TABLE, array('file_id'));
                        $column['writetime']['type'] = "now";
                        
                        $query = $DB->insertSql($column, $data, FILE_TABLE);
                        $DB->runQuery($query);
                        $this->Log($query, $menuID);
                        if($DB->affected_rows){
                            $isUpload = true;
                        }
                    }
                }
            }
            
        }
        
        return $isUpload;
    }
    
    
    /**
     * file_table 에서 file_id에 해당하는 첨부파일을 삭제함.
     * file_id를 조회하여 해당 파일을 menu_id 값을 찾아 파일 경로를 찾아낸 후 파일을 삭제
     * @param number $file_id
     */
    public function fileDelete($file_id = 0){
        
        global $DB, $menuID;
        $query = "SELECT * FROM ".FILE_TABLE." WHERE file_id = $file_id";
        $dbData = $DB->getDBData($query);
        
        if(count($dbData) > 0){
            $attach_file_name = $dbData[0]['attach_file_name'];
            $path = DATA_PATH."upload/";
            unlink($path.$attach_file_name);
            @unlink($path.str_replace("thumbnail_", "", $attach_file_name));      //섬네일 원본 삭제
            
            $query = "DELETE FROM ".FILE_TABLE."  WHERE file_id = $file_id";
            $DB->runQuery($query);
            
            $this->Log($query, $menuID);
            
        }
    }
    
    
    public function setHmode($text = '', $hmode = 0){
        
        if($hmode == 1) { // 태그 부분 허용
            $tmp = htmlspecialchars_decode($text);
            $text = strip_tags($tmp, '<p><br><span><a><img><table><thead><tbody><tfoot><tr><td><caption><ul><li><blockquote>');
        } else if($hmode == 2) { // 태그 모두 허용
            $text = htmlspecialchars_decode($text);
        } else { // 태그 허용 없음
            $text = nl2br(strip_tags($text));
        }
        
        return $text;
        
    }
    
    public function getHmode($html_use = 0, $grant = false){
        
        $hmode = 0;
        if($grant) $hmode = $html_use;
        return $hmode;
    }
    
    
    public function getBoardData($no = 0){
        
        global $DB;
        
        $query = "SELECT * FROM ".$this->tableName." WHERE indexcode = ".$no;
        $dbData = $DB->getDBData($query);
        
        if(count($dbData) == 0) $dbData = null;
        
        return $dbData;
    }
    
    
    
    public function getFileData($menu_id = 0, $no = 0, $type = 'files'){
        global $DB;
        
        $orderby = " ORDER BY file_id ASC";
        //첨부형태가 thumb 이거나 files 일경우만 menu_id를 체크한다.
        if($type == 'files' || $type == 'thumb'){
            if($type == 'thumb'){   //섬네일은 최근에 올린 순으로 정렬
                $orderby = " ORDER BY file_id DESC";
            }
            $query = "SELECT * FROM ".FILE_TABLE." WHERE menu_id = $menu_id AND indexcode = $no AND attach_type = '$type'".$orderby;
        }else{
            $query = "SELECT * FROM ".FILE_TABLE." WHERE indexcode = $no AND attach_type = '$type'".$orderby;
        }
        
        $dbData = $DB->getDBData($query);
        return $dbData;
        
    }
    
    public function getDeleteButtonText($opt = 0){
        
        $text = "";
        if($opt == 0){
            $text = "삭제";
        }else if($opt == 1){
            $text = "복구";
        }else if($opt == 2){
            $text = "완전삭제";
        }
        
        return $text;
        
    }
    
    /**
     * 게시물 삭제 함수
     * @param number $no 게시물 인덱스코드값
     * @param number $opt 삭제 옵션 ( 0 : 게시물 삭제(복구가능), 1 : 게시물 복구, 2 : 게시물 완전 삭제(복구 불가능 첨부파일 포함)
     * @param number $table ( 테이블 값이 1 이면 스킨에 설정된 db_table 에서 삭제 2이면 db_table2에서 삭제함. )
     */
    public function delete($no = 0, $opt = 0, $table = 1){
        global $menuID, $DB, $SKIN;
        
        $tableName = $table == 1 ? $SKIN->tableName : $SKIN->tableName2;
        
        if($no > 0)
        {
            if($opt == 0){	//게시물 삭제(복구가능)
                $query = "UPDATE ".$tableName." SET delflag = 1 WHERE indexcode = ".$no;
                $DB->runQuery($query);
            }else if($opt == 1){	//게시물 복구
                $query = "UPDATE ".$tableName." SET delflag = 0 WHERE indexcode = ".$no;
                $DB->runQuery($query);
            }else if($opt == 2){	//게시물 완전삭제(복구불가능) 게시물, 코멘트, 첨부파일까지 모두 삭제
                
                $query = "SELECT * FROM ".FILE_TABLE." WHERE menu_id = $menuID AND indexcode = ".$no;
                $dbData = $DB->getDBData($query);
                
                for($i = 0; $i < count($dbData); $i++){
                    
                    $file_id = intval($dbData[$i]['file_id']);
                    $this->fileDelete($file_id);	//첨부파일 삭제
                }
                
                //게시물 삭제
                $query = "DELETE FROM ".$tableName." WHERE indexcode = ".$no;
                $DB->runQuery($query);
                
                //코멘트 삭제
                $query = "DELETE FROM ".$tableName." WHERE iscomment = 1 AND parentcode = ".$no;
                $DB->runQuery($query);
                
            }
            
            
        }
    }
    
    public function move($no = 0, $target_id = 0){
        
        global $SKIN, $DB, $menuID, $userName, $menuInfo;
        
        $query = "SELECT * FROM ".$SKIN->tableName." WHERE indexcode = ".$no;
        $dbData = $DB->getDBData($query);
        
        $query = "SELECT db_table FROM ".MENU_TABLE." WHERE menu_id = ".$target_id;
        $menuData = $DB->getDBData($query);
        $tableName = $menuData[0]['db_table'];
        
        $dbData[0]['memo'] = htmlspecialchars_decode($dbData[0]['memo']);
        $origin_menu_title = $menuInfo['menu_title'];
        //$msg = "<p>[이 게시물은 ".$userName."님에 의해 ".$origin_menu_title."에서 이동 되었습니다. 이동 시간 : ".date("Y-m-d H:i:s")."]</p>";
        $msg = "";
        $dbData[0]['memo'] .= $msg;
        
        //이동할 db table에 insert
        $column = $DB->getColumns($tableName, array('indexcode'));
        $query = $DB->insertSql($column, $dbData[0], $tableName);
        $DB->runQuery($query);
        
        //기존 테이블에서 삭제
        $query = "DELETE FROM ".$SKIN->tableName." WHERE indexcode = ".$no;
        $DB->runQuery($query);
        
        //이동된 테이블에서 indexcode 값을 가져옴.
        $query = "SELECT max(indexcode) FROM ".$tableName;
        $dbData = $DB->getDBData($query);
        $newIndexcode = intval($dbData[0][0]);
        
        //첨부파일
        $query = "SELECT * FROM ".FILE_TABLE." WHERE menu_id = $menuID AND indexcode = $no";
        $fileData = $DB->getDBData($query);
        
        for($i = 0; $i < count($fileData); $i++){
            $_file_id = intval($fileData[$i]['file_id']);
            $attach_file_name = trim($fileData[$i]['attach_file_name']);
            
            $file1 = DATA_PATH.SITE_NAME."_".$menuID."/".$attach_file_name;
            $file2 = DATA_PATH.SITE_NAME."_".$target_id."/".$attach_file_name;
            copy($file1, $file2);	//파일 복사
            unlink($file1);			//기존 파일 제거
            
            //file table에서 menu_id값과 indexcode 값을 변경
            $query = "UPDATE ".FILE_TABLE." SET indexcode = $newIndexcode, menu_id = $target_id WHERE file_id = $_file_id";
            $DB->runQuery($query);
            $this->Log($query, $menuID);
        }
        
        
        //코멘트
        $query = "SELECT * FROM ".$SKIN->tableName." WHERE iscomment = 1 AND parentcode = ".$no;
        $commentData = $DB->getDBData($query);
        
        for($i = 0; $i < count($commentData); $i++){
            $_data = $commentData[$i];
            $_data['parentcode'] = $newIndexcode;
            $query = $DB->insertSql($column, $_data, $tableName);
            $DB->runQuery($query);
            
            $query = "DELETE FROM ".$SKIN->tableName." WHERE indexcode = ".$commentData[$i]['indexcode'];
            $DB->runQuery($query);
        }
        
    }
    
    public function copy($no = 0, $target_id = 0){
        
        global $SKIN, $DB, $menuID, $userName, $menuInfo;
        
        $query = "SELECT * FROM ".$SKIN->tableName." WHERE indexcode = ".$no;
        $dbData = $DB->getDBData($query);
        
        $query = "SELECT db_table FROM ".MENU_TABLE." WHERE menu_id = ".$target_id;
        $menuData = $DB->getDBData($query);
        $tableName = $menuData[0]['db_table'];
        
        $dbData[0]['memo'] = htmlspecialchars_decode($dbData[0]['memo']);
        $origin_menu_title = $menuInfo['menu_title'];
        //$msg = "<p>[이 게시물은 ".$userName."님에 의해 ".$origin_menu_title."에서 복사 되었습니다. 복사 시간 : ".date("Y-m-d H:i:s")."]</p>";
        $msg="";
        $dbData[0]['memo'] .= $msg;
        
        //이동할 db table에 insert
        $column = $DB->getColumns($tableName, array('indexcode'));
        $query = $DB->insertSql($column, $dbData[0], $tableName);
        $DB->runQuery($query);
        
        
        //이동된 테이블에서 indexcode 값을 가져옴.
        $query = "SELECT max(indexcode) FROM ".$tableName;
        $dbData = $DB->getDBData($query);
        $newIndexcode = intval($dbData[0][0]);
        
        //첨부파일
        $query = "SELECT * FROM ".FILE_TABLE." WHERE menu_id = $menuID AND indexcode = $no";
        $fileData = $DB->getDBData($query);
        
        for($i = 0; $i < count($fileData); $i++){
            $_file_id = intval($fileData[$i]['file_id']);
            $attach_file_name = trim($fileData[$i]['attach_file_name']);
            
            $file1 = DATA_PATH.SITE_NAME."_".$menuID."/".$attach_file_name;
            $file2 = DATA_PATH.SITE_NAME."_".$target_id."/".$attach_file_name;
            copy($file1, $file2);	//파일 복사
            
            //file table에서 변경 menu_id값과 indexcode 값을 insert
            $_data = array();
            $_data = $fileData[$i];
            $_data['menu_id'] = $target_id;
            $_data['indexcode'] = $newIndexcode;
            
            $column2 = $DB->getColumns(FILE_TABLE, array('file_id'));
            $query = $DB->insertSql($column2, $_data, FILE_TABLE);
            $DB->runQuery($query);
            $this->Log($query, $menuID);
            
        }
        
        
        //코멘트
        $query = "SELECT * FROM ".$SKIN->tableName." WHERE iscomment = 1 AND parentcode = ".$no;
        $commentData = $DB->getDBData($query);
        
        for($i = 0; $i < count($commentData); $i++){
            $_data = array();
            $_data = $commentData[$i];
            $_data['parentcode'] = $newIndexcode;
            $query = $DB->insertSql($column, $_data, $tableName);
            $DB->runQuery($query);
            
        }
        
    }
    
    
    
    public function input_hidden_upw(){
        
        $upw = isset($_GET['upw']) ? trim($_GET['upw']) : "";
        echo "<input type=\"hidden\" name=\"upw\" value=\"{$upw}\" />";
    }
    
    
    //상단 노출 게시물 날짜 값에 따라 노출 여부 값 수정
    public function isImportantDateCheck(){
        
        global $DB;
        
        $query = "UPDATE ".$this->tableName." SET isimportant = 1 WHERE date1 !='0000-00-00' AND DATE2 != '0000-00-00' and DATE1 <= '".TIME_YMD."' AND DATE2 >= '".TIME_YMD."'";
        $DB->runQuery($query);
        
        $query = "UPDATE ".$this->tableName." SET isimportant = 0 WHERE date1 !='0000-00-00' AND DATE2 != '0000-00-00' and ( DATE1 > '".TIME_YMD."' OR DATE2 < '".TIME_YMD."' )";
        $DB->runQuery($query);
        
        
    }
    
    
    public function Log($q = '', $menu_id = 0){
        global $DB;
        
        $q = str_replace("'", "`", $q);
        $query = "INSERT INTO ".FILELOG_TABLE." SET query = '".$q."', menu_id = $menu_id , writetime = now(), ip='".$_SERVER['REMOTE_ADDR']."'";
        $DB->runQuery($query);
        
    }
    
    public function initColumn($tableName = ''){
        global $DB;
        
        if($tableName == '')
            $tableName = $this->tableName;
        
            $column = $DB->getColumns($tableName);
        $arr = array();
        foreach($column as $k => $v){
            $arr[$k] = null;
        }
        return $arr;
    }
    
}