<?php 
$mode_array = array('list', 'view', 'calendar', 'write',  'myreservation');
$mode_default = 'list';
$mode = isset($_GET['mode']) ? trim($_GET['mode']) : $mode_default;
if(!in_array($mode, $mode_array)) {
    header('location:?menu='.$menuID);
}

$system['skin']['mode'] = $mode;
