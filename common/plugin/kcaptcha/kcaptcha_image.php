<?php
include "../../../common.php";
include_once('captcha.lib.php');

$captcha = new KCAPTCHA();
$captcha->setKeyString($_SESSION["ss_captcha_key"]);
$captcha->getKeyString();
$captcha->image();
?>