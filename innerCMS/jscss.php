<?php
$_prejs = $_js = $_css = array();
// common js
array_push($_prejs, "../common/js/jquery-1.11.1.min.js");
array_push($_prejs, "../common/js/jquery-migrate-1.2.1.min.js");
array_push($_prejs, "../common/js/jquery-ui-1.12.1.min.js");

// common css
array_push($_css, "../common/css/jquery-ui-1.8.16.custom.css");
array_push($_css, "../common/css/common.css");
array_push($_css, "jscss/common.css");

if ($menuID) {
	
	//사이트정보에서 서브페이지CSS가 적용되어 있으면 불러옴.
	if(isset($system['site']['subcss']) && $system['site']['subcss'] != ""){
		array_push($_css, $system['site']['subcss']);
	}
	
} else {
    array_push($_prejs, "jscss/chart.js");
    array_push($_prejs, "jscss/colors.js");
    
    //사이트정보에서 메인페이지CSS가 적용되어 있으면 불러옴.
    if(isset($system['site']['maincss']) && $system['site']['maincss'] != ""){
    	array_push($_css, $system['site']['maincss']);
    }
    
}
array_push($_js, "../common/js/datepicker.js");

array_push($_js, "jscss/common.js");
array_push($_js, "../common/js/common.js");

$system['jscss']['prejs'] = $_prejs;
$system['jscss']['js'] = $_js;
$system['jscss']['css'] = $_css;

if(isset($system['data']['menu']['menu_type']) && $system['data']['menu']['menu_type'] != "skin") $system['jscss']['prejs_skin'] = $system['jscss']['css_skin'] = $system['jscss']['js_skin'] = array();
