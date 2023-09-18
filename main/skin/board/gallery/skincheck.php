<?php
$_prejs_skin = $_js_skin = $_css_skin = array();
if ($mode == "view") {
    array_push($_js_skin, "jscss/comment.js");
}

$system['jscss']['prejs_skin'] = $_prejs_skin;
$system['jscss']['js_skin'] = $_js_skin;
$system['jscss']['css_skin'] = $_css_skin;