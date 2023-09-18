<?php
	$_file = SKIN_PATH.$system['skin']['mode'].".skin.php";
	if(file_exists($_file)){
		echo $system['data']['menu']['skin_header'];
		include $_file;
		echo $system['data']['menu']['skin_tail'];
	}else{
		echo "can't find file (".$system['skin']['mode'].".skin.php)";
	}

