<?php 
$contentsType = array('Layout', 'CSS', 'JavaScript', 'Skin');

function getDirContents($dir, &$results = array()) {
	$files = scandir($dir);

	foreach ($files as $key => $value) {
		
		$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
		if (!is_dir($path)) {
			$results[] = str_replace(BASE_PATH."/", "", $path);
		} else if ($value != "." && $value != "..") {
			getDirContents($path, $results);
// 			$results[] = $path;
		}
	}

	return $results;
}
