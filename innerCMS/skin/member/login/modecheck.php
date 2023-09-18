<?php 
$mode_array = array('login');
$mode_default = 'login';
$mode = isset($_GET['mode']) ? trim($_GET['mode']) : $mode_default;
if(!in_array($mode, $mode_array)) {
    header('location:?menu='.$menuID);
}

$system['skin']['mode'] = $mode;
