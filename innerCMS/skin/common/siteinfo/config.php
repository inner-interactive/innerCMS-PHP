<?php 
$siteInfoTitle = array('author' => '사이트명', 'description' => '사이트 설명', 'keyword' => "키워드", 'build' => '생성일', 'email' => '이메일', 'maincss' => '메인페이지CSS', 'subcss' => '서브페이지CSS');


$saveTxt = '<?php 
if ( ! defined("BASE_PATH")) exit("No direct script access allowed");
$site = array();
$site["author"] = "{author}";
$site["description"] = "{description}";
$site["keyword"] = "{keyword}";
$site["build"] = "{build}";
$site["email"] = "{email}";
$site["maincss"] = "{maincss}";
$site["subcss"] = "{subcss}";
$system["site"] = $site;
unset($site);';


?>