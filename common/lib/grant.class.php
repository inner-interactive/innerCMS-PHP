<?php
class Grant
{
    
    var $user_id;
    var $user_level;
    var $secret_mode = false;	//비밀글 여부
    var $writer_mode = false;	//자신의 글인지 타인의 글인지 여부
    var $login_mode = false;	//로그인 여부
    var $pass_mode = false;		//패스워드 체크 여부
    var $get_upw = null;
    var $mode_type = 0;
    
    var $dbData = null;
    
    var $grant = array(
        'auth_list' => false,
        'auth_view' => false,
        'auth_write' => false,
        'auth_comment' => false,
        'auth_reply' => false,
        'auth_alltag' => false,
        'auth_gongji' => false,
        'auth_secret' => false,
        'auth_fileup' => false,
        'auth_filedown' => false,
        'auth_admin' => false,
        'auth_update' => false
    );
    var $allow = false;			// 권한 허용 여부
    
    public function __construct ($no = 0)
    {
        global $SKIN, $DB;
        
        $this->user_id = isset($_SESSION['user_id']) && trim($_SESSION['user_id']) != "" ? trim($_SESSION['user_id']) : "";
        $this->user_level = isset($_SESSION['user_level']) && intval($_SESSION['user_level']) > 0 ? intval($_SESSION['user_level']) : 0;
        
        foreach($this->grant as $key => $value){
            $this->grant[$key] = isset($SKIN->$key) && $this->user_level >= $SKIN->$key ? true : false;
        }
        
        
        if($no == 0)
            $no = isset($_REQUEST['no']) && intval($_REQUEST['no']) > 0 ? intval($_REQUEST['no']) : 0;
            else
                $no = intval($no);
                
                $dbData = $no > 0 && $SKIN->tableName != "" ? $SKIN->getBoardData($no) : null;
                
                
                if($dbData != null){
                    
                    $this->dbData = $dbData;
                    $this->secret_mode = isset($this->dbData[0]['issecret']) && intval($this->dbData[0]['issecret']) == 1 ? true : false;
                    $this->login_mode = isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" ? true : false;
                    $this->reply_mode = false;
                    $db_uid = isset($this->dbData[0]['uid']) ? trim($this->dbData[0]['uid']) : "";
                    
                    
                    if($this->secret_mode && $this->dbData[0]['replyfrom'] > 0){
                        /* 답글일 경우 원문의 사용자가 답글이 비밀글일지라도 볼수 있게 하기 위함. */
                        $_data = $SKIN->getBoardData($this->dbData[0]['replyfrom']);
                        $db_uid = $_data[0]['uid'];
                        if($this->user_id == $_data[0]['uid']){
                            $this->reply_mode = true;
                        }
                    }
                    /**
                     * mode_type
                     * 1 : 로그인 사용자의 글이며 현재 로그인한 상태
                     * 2 : 로그인 사용자글이며 현재 비로그인 상태
                     * 3 : 비로그인 사용자글이며 현재 로그인한 상태
                     * 4 : 비로그인 사용자글이며 현재 비로그인 상태
                     */
                    
                    if($db_uid != ""){
                        $this->mode_type = $this->login_mode ? 1 : 2;
                        $this->writer_mode = $db_uid == $this->user_id ? true : false;
                        
                        
                    }else{
                        $this->mode_type = $this->login_mode ? 3 : 4;
                        $this->writer_mode = $db_uid == "" ? true : false;
                        
                        $this->get_upw = isset($_REQUEST['upw']) && trim($_REQUEST['upw']) != "" ? base64_decode(trim($_REQUEST['upw'])) : "";
                        if($this->get_upw != "")
                        {
                            $query = "SELECT password('{$this->get_upw}')";
                            $_data = $DB->getDBData($query);
                            $db_upw = $_data[0][0];
                            
                            if($db_upw == $this->dbData[0]['upw']){
                                $this->pass_mode = true;
                            }
                        }
                    }
                    
                    
                }
                
    }
    
    
    public function goPasswordPage(){
        header('location:./password.php?backUrl='.urlencode(getBackUrl(BACKURL_VALUE)));
    }
    
    
    public function alertLoginPage(){
        alert('로그인이 필요합니다.', "./route.php?action=login&backUrl=".urlencode(getBackUrl(BACKURL_VALUE, 1)));
    }
    
    
    
    
    public function listModeCheck(){
        
        if(!$this->grant['auth_list']){
            alert('글 목록을 볼 권한이 없습니다.');
        }else{
            $this->allow = true;
        }
        
    }
    
    
    /* write */
    public function writeModeCheck(){
        
        if(!$this->grant['auth_write']){
            alert('글쓰기 권한이 없습니다. 회원이시면 로그인 후 이용해 주십시요.');
        }else{
            $this->allow = true;
        }
    }
    
    
    
    public function writeGrantCheck(){
        if(!$this->grant['auth_write']){
            alert('글쓰기 권한이 없습니다.');
        }
    }
    
    public function replyModeCheck(){
        
        if(!$this->grant['auth_reply']){
            alert('답글쓰기 권한이 없습니다. 회원이시면 로그인 후 이용해 주십시요.');
        }else{
            $this->allow = true;
        }
    }
    
    
    /* reply */
    public function replyGrantCheck(){
        if(!$this->grant['auth_reply']){
            alert('답글쓰기 권한이 없습니다.');
        }
    }
    
    
    /* view */
    public function viewModeCheck(){
        
        if($this->secret_mode){	//비밀글일경우
            
            //관리자나 비밀글 패스워드가 일치 하면 통과
            if($this->grant['auth_admin'] || $this->pass_mode){
                $this->allow = true;
            }else{
                
                switch ($this->mode_type){
                    case 1 :
                        
                        /* 답글을 원문의 indexcode값이 저장이 된다. 원문 사용자의 id값을 조회하여 원문의 사용자의 답글이 비밀글이라도 원문의 사용자는 볼 수 있도록 하기 위함이다. */
                        if(!$this->reply_mode){
                            alert('비밀글 읽기 권한이 없습니다.');
                        }
                        break;
                        
                    case 2 :
                        $this->alertLoginPage();
                        break;
                    case 3 :
                        alert('비밀글 읽기 권한이 없습니다.');
                        break;
                    case 4 :
                        
                        if(!$this->pass_mode){
                            $this->goPasswordPage();
                        }
                        break;
                }
                
                
            }
            
            
        }else{	//비밀글이 아닐 경우
            
            //글 보기 권한이 있는지 체크
            if(!$this->grant['auth_view']){
                alert('글보기 권한이 없습니다.');
                
            }else{
                $this->allow = true;
            }
        }
        
        
        //뷰페이지 답글 쓰기 권한
        $this->grant['auth_reply'] = $this->grant['auth_reply'] && isset($this->dbData[0]['delflag']) && $this->dbData[0]['delflag'] == 0 ? true : false;
        
        //뷰페이지 수정 권한  (writer_mode 이거나 관리자 권한일 경우만 주어짐.)
        $this->grant['auth_update'] = $this->writer_mode || $this->grant['auth_admin'] ? true : false;
    }
    
    
    /* update */
    
    public function updateModeCheck(){
        if(!$this->pass_mode && $this->mode_type == 4){
            $this->goPasswordPage();
        }
        
    }
    
    public function updateGrantCheck(){
        if(!$this->pass_mode && $this->mode_type == 4){
            alert('글 수정 권한이 없습니다.');
        }
    }
    
    
    /* delete */
    public function deleteModeCheck(){
        $this->updateModeCheck();
    }
    
    public function deleteGrantCheck(){
        if(!$this->pass_mode && $this->mode_type == 4){
            alert('삭제 권한이 없습니다.');
        }
    }
    
    
    /* comment write */
    public function commentWriteGrantCheck(){
        if(!$this->grant['auth_comment']){
            alert('코멘트 쓰기 권한이 없습니다.');
        }
    }
    
    public function commentReplyGrantCheck(){
        if(!$this->grant['auth_comment']){
            alert('코멘트 답글 쓰기 권한이 없습니다.');
        }
    }
    
    public function commentUpdateGrantCheck($upw = ''){
        
        if($this->mode_type == 4)
        {
            $DB = new DB();
            $query = "SELECT password('{$upw}')";
            $_data = $DB->getDBData($query);
            $db_upw = $_data[0][0];
            
            if($db_upw != $this->dbData[0]['upw']){
                alert('코멘트 등록시 입력한 비밀번호와 일치하지 않습니다.');
            }
        }
        
    }
    
    public function commenDeleteGrantCheck($upw = ''){
        $this->commentUpdateGrantCheck($upw);
    }
    
}