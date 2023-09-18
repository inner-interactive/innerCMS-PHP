<?php
$mode_array = array('calendar', 'list', 'write', "update", "delete");
$mode_default = 'calendar';
$mode = isset($_GET['mode']) ? trim($_GET['mode']) : $mode_default;
if (! in_array($mode, $mode_array)) {
    header('location:?menu=' . $menuID);
}

$system['skin']['mode'] = $mode;
