<?php
$seperator = substr(PHP_OS, 0, 3) != "WIN" ? "/" : "\\";
$tmp = explode($seperator, dirname(__FILE__));
$_site = trim($tmp[count($tmp) - 1]);
define("SITE_NAME", $_site);
unset($tmp, $_site);

$backUrl = isset($_GET['backUrl']) && $_GET['backUrl'] != "" ? trim($_GET['backUrl']) : "./";