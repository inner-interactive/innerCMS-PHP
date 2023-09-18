<?php
include_once COMMON_PATH."lib/menu.class.php";
$menu = new Menu();

if(!$isAdmin){
    session_destroy();
}