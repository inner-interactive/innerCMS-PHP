<?php
$seperator = substr(PHP_OS, 0, 3) != "WIN" ? "/" : "\\";
$tmp = explode($seperator, dirname(__FILE__));
$_site = trim($tmp[count($tmp) - 1]);
define("SITE_NAME", $_site);
unset($tmp, $_site);

$system['data']['phone'] = array('02', '031', '032', '033', '041', '043', '042', '044', '051', '052', '053', '054', '055', '061', '062', '063', '064', '070');
$system['data']['mobile'] = array('010', '011', '016', '017', '019');

