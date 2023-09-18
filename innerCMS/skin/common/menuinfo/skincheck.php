<?php 
$_prejs_skin = $_js_skin = $_css_skin = array();

array_push($_css_skin, SKIN_URL."jscss/menuinfo.css");    

if($mode == 'write' || $mode == 'update'){
    array_push($_js_skin, "../common/plugin/edit_area/edit_area_full.js");    
    array_push($_js_skin, SKIN_URL."jscss/write.js");    
}else if($mode == 'arrange'){
    array_push($_js_skin, SKIN_URL."jscss/arrange.js");    
}else if($mode == 'list'){
    array_push($_js_skin, SKIN_URL."jscss/list.js");    
}


$system['jscss']['prejs_skin'] = $_prejs_skin;
$system['jscss']['js_skin'] = $_js_skin;
$system['jscss']['css_skin'] = $_css_skin;
