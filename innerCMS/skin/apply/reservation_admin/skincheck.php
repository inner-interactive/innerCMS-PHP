<?php 
$_prejs_skin = $_js_skin = $_css_skin = array();

array_push($_css_skin, SKIN_URL."jscss/style.css");    
array_push($_js_skin, SKIN_URL."jscss/common.js");    

if($mode == 'write' || $mode == 'update'){
    array_push($_js_skin, SKIN_URL."jscss/write.js");    
}

$system['jscss']['prejs_skin'] = $_prejs_skin;
$system['jscss']['js_skin'] = $_js_skin;
$system['jscss']['css_skin'] = $_css_skin;