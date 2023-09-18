<?php
	$_file = SKIN_PATH.$system['skin']['mode'].".inc.php";
	echo $system['data']['menu']['skin_header'];
	if(file_exists($_file)){
		include $_file;
	}else{
		echo "can't find file (".$system['skin']['mode'].".inc.php)";
	}
	echo $system['data']['menu']['skin_tail'];

