<?php
$_prejs_skin = $_js_skin = $_css_skin = array();
if ($mode == "write") {
    array_push($_js_skin, "../common/js/common.js");
    array_push($_js_skin, SKIN_URL . "jscss/join.js");
}
array_push($_css_skin, SKIN_URL . "jscss/join.css");

$system['jscss']['prejs_skin'] = $_prejs_skin;
$system['jscss']['js_skin'] = $_js_skin;
$system['jscss']['css_skin'] = $_css_skin;