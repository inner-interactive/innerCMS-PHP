<?php
$_file = SKIN_PATH.$system['skin']['mode'].".inc.php";
echo $SKIN->skinHeader;
if(file_exists($_file)){
	echo '<div class="reserv-container">';
	include $_file;
	echo '</div>';
}else{
	echo "can't find file (".$system['skin']['mode'].".inc.php)";
}
echo $SKIN->skinTail;

