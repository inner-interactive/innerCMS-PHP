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
    array_push($_css, "jscss/sub.css");
} else {
    array_push($_css, "jscss/main.css");
}
    array_push($_js, "../common/js/datepicker.js");

array_push($_js, "jscss/common.js");
array_push($_js, "../common/js/common.js");

$system['jscss']['prejs'] = $_prejs;
$system['jscss']['js'] = $_js;
$system['jscss']['css'] = $_css;

if($system['data']['menu']['menu_type'] != "skin") $system['jscss']['prejs_skin'] = $system['jscss']['css_skin'] = $system['jscss']['js_skin'] = array();
