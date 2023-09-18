<?php
if ($system['data']['menu']['skin_group'] != "" && $system['data']['menu']['skin'] != "") {
    include_once COMMON_PATH . "lib/grant.class.php";
    include_once COMMON_PATH . "lib/skin.class.php";
    include_once COMMON_PATH . "plugin/kcaptcha/captcha.lib.php";

    $SKIN = new Skin($system['data']['menu']);

    $skin_group = trim($system['data']['menu']['skin_group']);
    $skin_name = trim($system['data']['menu']['skin']);

    define("SKIN_PATH", BASE_PATH . "/" . SITE_NAME . "/skin/" . $skin_group . "/" . $skin_name . "/");
    define("SKIN_URL", "skin/" . $skin_group . "/" . $skin_name . "/");
    define("BASE_SKIN_PATH", BASE_PATH . "/" . SITE_NAME . "/skin/base/board/");

    if (file_exists(SKIN_PATH . "modecheck.php"))
        include SKIN_PATH . "modecheck.php";
    if (file_exists(SKIN_PATH . "skincheck.php")) {
        include SKIN_PATH . "skincheck.php";
    } else {
        $system['jscss']['prejs_skin'] = $system['jscss']['css_skin'] = $system['jscss']['js_skin'] = array();
    }

    $GRANT = new Grant();
    $method = $mode . "ModeCheck";
    if (method_exists($GRANT, $method)) {
        $grant_check = $GRANT->$method();
    }
    $grantValue = $GRANT->grant;
    if (file_exists(SKIN_PATH . "/config.php"))
        include_once SKIN_PATH . "/config.php";
    if (file_exists(SKIN_PATH . "sql.php"))
        include SKIN_PATH . "sql.php";
    $system['data']['dbData'] = isset($system['data']['dbData']) ? $system['data']['dbData'] : null;
}
