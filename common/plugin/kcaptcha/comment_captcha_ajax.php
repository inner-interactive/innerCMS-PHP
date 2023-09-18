<?php 
include_once "../../../common.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once(dirname(__FILE__).'/kcaptcha_config.php');
include_once('captcha.lib.php');

$captcha_html = captcha_html();
echo $captcha_html;
?>