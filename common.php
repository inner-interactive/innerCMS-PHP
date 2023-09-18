<?php
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Origin:*"); // 크로스 도메인 요청 허용(설정을 하지 않았을 때 CORS 이슈 발생)
header("X-Frame-Options: DENY");

date_default_timezone_set('Asia/Seoul');



define('ENVIRONMENT', 'debuging');
if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
		case 'testing':
			error_reporting(E_ERROR | E_WARNING | E_PARSE );
			ini_set("display_errors",1);
			break;
			
		case 'debuging' :
			error_reporting(E_ALL);
			ini_set("display_errors",1);
			break;
			
		case 'production':
			error_reporting(0);
			ini_set("display_errors", 0);
			break;

		default:
			exit('The application environment is not set correctly.');
	}
}


//경로 관련
define("BASE_PATH", strtr(dirname(__FILE__), "\\", "/"));
define("SESSION_PATH", BASE_PATH . "/session");
define("COMMON_PATH", BASE_PATH . "/common/");
define("DATA_PATH", BASE_PATH . "/data/");
define("CAPTCHA_PATH", COMMON_PATH."/plugin/kcaptcha");


function cms_path()
{
	$chroot = substr($_SERVER['SCRIPT_FILENAME'], 0, strpos($_SERVER['SCRIPT_FILENAME'], dirname(__FILE__)));
	$result['path'] = str_replace('\\', '/', $chroot.dirname(__FILE__));
	$tilde_remove = preg_replace('/^\/\~[^\/]+(.*)$/', '$1', $_SERVER['SCRIPT_NAME']);
	$document_root = str_replace($tilde_remove, '', $_SERVER['SCRIPT_FILENAME']);
	$pattern = '/' . preg_quote($document_root, '/') . '/i';
	$root = preg_replace($pattern, '', $result['path']);
	$port = ($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443) ? '' : ':'.$_SERVER['SERVER_PORT'];
	$http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
	$user = str_replace(preg_replace($pattern, '', $_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']);
	$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
	if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
		$host = preg_replace('/:[0-9]+$/', '', $host);
		$host = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", '', $host);
		$result['url'] = $http.$host.$port.$user.$root;
		return $result;
}
$_path = cms_path();

define("BASE_URL", $_path['url']);
define("CAPTCHA_URL", "../common/plugin/kcaptcha");
define("EDITOR_URL", "../smarteditor2");
define("DATA_URL", $_path['url']."/data/");
unset($_path);

//세션 관련
define("session_lifetime" , 1800);					// 자동로그아웃 기능을 위함 (1800초 = 30분)
session_save_path(SESSION_PATH);
session_cache_limiter('private');
session_cache_limiter('nocache, Must_revalidate');
session_set_cookie_params(0,"/");
session_start();

if(!isset($_SESSION['pretime'])) $_SESSION['pretime'] = 0;
$time_gap = intval(time()) - intval($_SESSION['pretime']);

if($time_gap > session_lifetime && intval($_SESSION['pretime']) != 0 && isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
	$_SESSION['pretime'] = 0;								

}else{
	$_SESSION['pretime'] = time();							
}





//db테이블
define("MEMBER_TABLE", "memberinfo");				//회원정보테이블
define("RETIRE_TABLE", "retireinfo");			//탈퇴회원정보테이블
define("MENU_TABLE", "menuinfo");					//메뉴정보테이블
define("CONTENTS_TABLE", "contents");				//콘텐츠 테이블
define("GROUP_TABLE", "groupinfo");					//회원그룹정보테이블
define("FILE_TABLE", "fileinfo");					//게시판 첨부파일 테이블
define("FILELOG_TABLE", "filelog");					//게시판 첨부파일 처리 로그 테이블
define("POPUP_TABLE", "popup");						//팝업 테이블
define("VISIT_TABLE", "visit");						//접속자 정보 테이블
define("VISIT_SUM_TABLE", "visit_sum");				//접속자 합계 테이블
define("VISIT_PAGEVIEW_TABLE", "visit_pageview");	//페이지뷰 테이블
define("DEPT_TABLE", 'inner_department');			//학과정보 테이블
define("ORG_TABLE", 'organization');				//기관(조직도) 테이블
define("BANNER_TABLE", 'banner');					//배너테이블
define("COMPLAIN_TABLE", 'complain');				//민원사항 테이블
define("SEARCH_HISTORY_TABLE", "search_history");   //검색이력 테이블
define("LOGIN_HISTORY_TABLE", 'logininfo');         //로그인이력 테이블


//기타 설정값
define('SERVER_TIME',    time());
define('TIME_YMDHIS',    date('Y-m-d H:i:s', SERVER_TIME));
define('TIME_YMD',       substr(TIME_YMDHIS, 0, 10));
define('TIME_HIS',       substr(TIME_YMDHIS, 11, 8));
$WEEKDAY = array("일", "월", "화", "수", "목", "금", "토");


//민원 사항 사용 여부
define("COMPLAIN_USE", false);

// Browscap 사용여부를 설정합니다.
define('BROWSCAP_USE' , true);

// 접속자 기록 때 Browscap 사용여부를 설정합니다.
define('VISIT_BROWSCAP_USE', true);


define("DEFAULT_UPLOAD_EXT", "hwp,hwx,doc,docx,ppt,pptx,txt,jpg,gif,png,jpeg,bmp,psd,pdf,ai,zip,alz,xls,xlsx,wmv");

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신일때 daum 주소 js
	define('POSTCODE_JS', '<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>');
} else {  //http 통신일때 daum 주소 js
	define('POSTCODE_JS', '<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>');
}

include 'autologincheck.php';

$isAdmin = isset($_SESSION['user_level']) && $_SESSION['user_level'] != 0 && $_SESSION['user_level'] >= 90 ? true : false;
$userID = isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" ? trim($_SESSION['user_id']) : "";
$userName = isset($_SESSION['user_uname']) && $_SESSION['user_uname'] != "" ? trim($_SESSION['user_uname']) : "";
if($userName == "") $userName = isset($_SESSION['user_realname']) && $_SESSION['user_realname'] != "" ? trim($_SESSION['user_realname']) : "";
$full_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$menuID = isset($_REQUEST['menu']) ? intval($_REQUEST['menu']) : 0;
$no = isset($_REQUEST['no']) ? intval($_REQUEST['no']) : 0;

$_GET['sfv'] = isset($_GET['sfv']) ? trim($_GET['sfv']) : "";
$_GET[$_GET['sfv']] = isset($_GET[$_GET['sfv']])  ? trim($_GET[$_GET['sfv']]) : "";
$_POST['backUrl'] = isset($_POST['backUrl']) ? urldecode($_POST['backUrl']) : "";
if($_POST['backUrl'] == "") unset($_POST['backUrl']);

define("BACKURL_VALUE", "menu|mode|no|pno|category|limit|".$_GET['sfv']."|sfv|opt");

//보안관련
define("NO_DIRECT_SOURCE", "<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed'); ?>");


// XSS 관련 태그 제거
function clean_xss_tags($str)
{
	$str_len = strlen($str);

	$i = 0;
	while($i <= $str_len){
		$result = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $str);

		if((string)$result === (string)$str) break;

		$str = $result;
		$i++;
	}

	return $str;
}


// multi-dimensional array에 사용자지정 함수적용
function array_map_deep($fn, $array)
{
	if(is_array($array)) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				$array[$key] = array_map_deep($fn, $value);
			} else {
				$array[$key] = call_user_func($fn, $value);
			}
		}
	} else {
		$array = call_user_func($fn, $array);
	}

	return $array;
}


if (get_magic_quotes_gpc()) {
	$_POST    = array_map_deep('stripslashes',  $_POST);
	$_GET     = array_map_deep('stripslashes',  $_GET);
	$_COOKIE  = array_map_deep('stripslashes',  $_COOKIE);
	$_REQUEST = array_map_deep('stripslashes',  $_REQUEST);
}

// if(!$isAdmin){
    //SQL injection
//     $_POST    = array_map_deep('addslashes',  $_POST);
//     $_GET     = array_map_deep('addslashes',  $_GET);
//     $_COOKIE  = array_map_deep('addslashes',  $_COOKIE);
//     $_REQUEST = array_map_deep('addslashes',  $_REQUEST);
    
    //XSS
    
    $_POST    = array_map_deep('clean_xss_tags',  $_POST);
    $_GET     = array_map_deep('clean_xss_tags',  $_GET);
    $_COOKIE  = array_map_deep('clean_xss_tags',  $_COOKIE);
    $_REQUEST = array_map_deep('clean_xss_tags',  $_REQUEST);
// }


$bannerConfig = array(
		'top' => array(
				'title' => '상단배너',
				'listHeaderText' => '사이트|제목|배너기간|배너상태|보기',
				'listColumn' => 'site|title|term|state|view',
				'writeColumn' => 'title|link|site|term|target|stop|image',
				'imageSize' => '1140*108'
		),
		'maintext' => array(
				'title' => '메인텍스트배너',
				'listHeaderText' => '사이트|제목|소제목|배너링크|배너상태|보기',
				'listColumn' => 'site|title|subtitle|link|state|view',
				'writeColumn' => 'title|subtitle|site|link|term|target|stop|memo',
		)
		,
		'backimage' => array(
				'title' => '배경이미지배너',
				'listHeaderText' => '사이트|배너이미지|배너기간|보기',
				'listColumn' => 'site|image|term|view',
				'writeColumn' => 'site|term|target|stop|image',
				'imageSize' => '2000*559'
		),
		'dday' => array(
				'title' => 'D-day배너',
				'listHeaderText' => '사이트|제목|배너링크|D-day|D-day상태|삭제',
				'listColumn' => 'site|title|link|dday|ddaystate|delete',
				'writeColumn' => 'site|title|link|dday|target|stop'
		),
		'tag' => array(
				'title' => '태그배너',
				'listHeaderText' => '사이트|태그명|삭제',
				'listColumn' => 'site|title|delete',
				'writeColumn' => 'site|tag'
		)
);
