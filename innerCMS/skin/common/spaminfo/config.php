<?php 
include_once COMMON_PATH."/conf/spam.php";

$saveTxt = '<?php
if ( ! defined("BASE_PATH")) exit("No direct script access allowed");
define("SPAM_WORD", "{spam}");';
