<?php
function getBannerData($config = null, $type = ''){
    global $DB;
    
    if($config == null || $type == '') return null;
    
    $data = array();
    
    $whereSite = in_array('site', $config) ? " AND site =  '".SITE_NAME."'" : "";
    $whereStop = in_array('stop', $config) ? ' AND isstop = 0 ' : "";
    $whereTerm = in_array('term', $config) ? " AND start_date <= '".TIME_YMD."' AND end_date >= '".TIME_YMD."' " : "";
    if($type == 'dday'){
        $whereTerm .= " AND start_date >= '".TIME_YMD."'";
    }
    
    $query = "SELECT * FROM ".BANNER_TABLE." WHERE banner_type = '{$type}' $whereSite $whereStop $whereTerm ORDER BY sort DESC";
    
    $data = $DB->getDBData($query);
    
    return $data;
    
}
?>