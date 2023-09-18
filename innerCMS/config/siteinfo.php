<?php 
if ( ! defined("BASE_PATH")) exit("No direct script access allowed");
$site = array();
$site["author"] = "사이트 관리자모드";
$site["description"] = "";
$site["keyword"] = "";
$site["build"] = "2020-03-06";
$site["email"] = "cs@inner515.co.kr";
$site["maincss"] = "jscss/main.css";
$site["subcss"] = "jscss/sub.css";
$system["site"] = $site;
unset($site);