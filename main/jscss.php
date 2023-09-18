<?php
$_prejs = $_js = $_css = array();
// common js
array_push($_prejs, "../common/js/jquery-1.11.1.min.js");
array_push($_prejs, "../common/js/jquery-migrate-1.2.1.min.js");
array_push($_prejs, "../common/js/jquery-ui-1.12.1.min.js");
array_push($_js, "../common/js/jquery.mtree.js");
array_push($_js, "../common/js/jquery.bpopup.min.js");
array_push($_js, "jscss/menu.js");
array_push($_js, "jscss/common.js");
array_push($_js, "../common/js/swiper.js");
array_push($_js, "../common/js/slick.min.js");
array_push($_js, "jscss/banner.js");

// common css
array_push($_css, "../common/css/jquery-ui-1.8.16.custom.css");
array_push($_css, "../common/css/common.css");
array_push($_css, "jscss/common.css");
array_push($_css, "jscss/fonts.css");
array_push($_css, "../common/css/swiper.css");
array_push($_css, "jscss/banner.css");

if ($menuID) {
    // 사이트정보에서 서브페이지CSS가 적용되어 있으면 불러옴.
    if (isset($system['site']['subcss']) && $system['site']['subcss'] != "") {
        array_push($_css, $system['site']['subcss']);
    }
    array_push($_js, "jscss/sub.js");
} else {
    if (defined('PASSWORD_CHECK')) {
        array_push($_css, "jscss/sub.css");
        array_push($_css, "jscss/skin.css");
    }
    
    // 사이트정보에서 메인페이지CSS가 적용되어 있으면 불러옴.
    if (isset($system['site']['maincss']) && $system['site']['maincss'] != "") {
        array_push($_css, $system['site']['maincss']);
    }
    
    array_push($_js, "jscss/main.js");
}

if (isset($system['data']['menu']['menu_type']) && $system['data']['menu']['menu_type'] == "skin") {
    array_push($_css, "jscss/skin.css");
    array_push($_js, "jscss/skin_common.js");
    
    if ($GRANT->grant['auth_admin'])
        array_push($_js, "jscss/admin.js");
}

$system['jscss']['prejs'] = $_prejs;
$system['jscss']['js'] = $_js;
$system['jscss']['css'] = $_css;

if (isset($system['data']['menu']['menu_type']) && $system['data']['menu']['menu_type'] != "skin")
    $system['jscss']['prejs_skin'] = $system['jscss']['css_skin'] = $system['jscss']['js_skin'] = array();
    