<div id="container">
<?php
$page_file = getPageFile($system['data']['menu']);
if($page_file != "" && file_exists($page_file)) {
	include $page_file;
} else {
	echo "can't find file : " . $page_file;
}
?>
</div>


