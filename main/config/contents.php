<?php 
$use_file = $system['data']['menu']['use_file'];
if($use_file){
    
    $inc_file = BASE_PATH."/".SITE_NAME."/inc/".$menuID.".php";
    include $inc_file;
    
}else{
    $query = "SELECT contents FROM ".CONTENTS_TABLE." WHERE menu_id = {$menuID} AND isapply = 1 ORDER BY content_id DESC LIMIT 1";
    $dbData = $DB->getDBData($query);
    $contents = count($dbData) > 0 ? htmlspecialchars_decode($dbData[0]['contents']) : "";
    echo $contents;
}
?>