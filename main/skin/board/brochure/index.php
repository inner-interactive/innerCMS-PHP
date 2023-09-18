<?php
$_file = SKIN_PATH . $system['skin']['mode'] . ".inc.php";
echo $SKIN->skinHeader;
if (file_exists($_file)) {
    include $_file;
} else {
    echo "can't find file (" . $system['skin']['mode'] . ".inc.php)";
}
echo $SKIN->skinTail;

