<?php 
$_prejs_skin = $_js_skin = $_css_skin = array();

array_push($_css_skin, SKIN_URL."jscss/style.css");

if($mode == "write" || $mode == "update"){
	array_push($_js_skin, SKIN_URL."jscss/address.js");    
}

if($isAdmin && $mode == "list"){
	array_push($_js_skin, BASE_SKIN_URL."jscss/admin.js");
}

$system['jscss']['prejs_skin'] = $_prejs_skin;
$system['jscss']['js_skin'] = $_js_skin;
$system['jscss']['css_skin'] = $_css_skin;