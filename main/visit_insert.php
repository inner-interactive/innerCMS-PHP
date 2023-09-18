<?php
if (! defined('BASE_PATH'))
    exit(); // 개별 페이지 접근 불가
    
    // 컴퓨터의 아이피와 쿠키에 저장된 아이피가 다르다면 테이블에 반영함
    if (get_cookie('ck_visit_ip_'.SITE_NAME) != $_SERVER['REMOTE_ADDR']) {
        set_cookie('ck_visit_ip_'.SITE_NAME, $_SERVER['REMOTE_ADDR'], 86400); // 하루동안 저장
        
        // $_SERVER 배열변수 값의 변조를 이용한 SQL Injection 공격을 막는 코드입니다. 110810
        $remote_addr = trim($_SERVER['REMOTE_ADDR']);
        $referer = "";
        if (isset($_SERVER['HTTP_REFERER']))
            $referer = trim(clean_xss_tags($_SERVER['HTTP_REFERER']));
            $user_agent = trim(clean_xss_tags($_SERVER['HTTP_USER_AGENT']));
            $vi_browser = '';
            $vi_os = '';
            $vi_device = '';
            if (version_compare(phpversion(), '5.3.0', '>=') && defined('BROWSCAP_USE') && BROWSCAP_USE) {
                include_once ('visit_browscap.php');
            }
            //다른 브라우저로 접속한 경우도 카운트 하지 않음.
            $query = " SELECT count(*) FROM " . VISIT_TABLE." WHERE site = '".SITE_NAME."' AND vi_ip = '".$remote_addr."' AND vi_date = '".TIME_YMD."'";
            $tmpData = $DB->getDBData($query);
            if (intval($tmpData[0][0]) == 0) {
                
                $query = " INSERT " . VISIT_TABLE . " ( site, vi_ip, vi_date, vi_time, vi_referer, vi_agent, vi_browser, vi_os, vi_device ) VALUES ( '".SITE_NAME."', '{$remote_addr}', '" . TIME_YMD . "', '" . TIME_HIS . "', '{$referer}', '{$user_agent}', '{$vi_browser}', '{$vi_os}', '{$vi_device}' ) ";
                $DB->runQuery($query);
                
                // 정상으로 INSERT 되었다면 방문자 합계에 반영
                if ($DB->affected_rows > 0) {
                    $query = "SELECT count(*) FROM " . VISIT_SUM_TABLE . " WHERE site = '".SITE_NAME."' AND vs_date = '" . TIME_YMD . "'";
                    $tmpData = $DB->getDBData($query);
                    
                    if (intval($tmpData[0][0]) > 0) {
                        $query = " UPDATE " . VISIT_SUM_TABLE . " SET vs_count = vs_count + 1 WHERE site = '".SITE_NAME."' AND vs_date = '" . TIME_YMD . "' ";
                        $result = $DB->runQuery($query);
                    } else {
                        $query = " INSERT " . VISIT_SUM_TABLE . " ( vs_count, site, vs_date) VALUES ( 1, '".SITE_NAME."'  ,'" . TIME_YMD . "' ) ";
                        $DB->runQuery($query);
                    }
                }
            }
            
    }
    
    // pageview
    $query = "SELECT count(*) FROM " . VISIT_PAGEVIEW_TABLE . " WHERE site = '" . SITE_NAME . "' AND menu_id = $menuID";
    $tmpData = $DB->getDBData($query);
    
    if (intval($tmpData[0][0]) > 0) {
        
        $query = "UPDATE " . VISIT_PAGEVIEW_TABLE . " SET page_count = page_count + 1 WHERE site = '" . SITE_NAME . "' AND menu_id = $menuID";
        $DB->runQuery($query);
    } else {
        $query = " INSERT " . VISIT_PAGEVIEW_TABLE . " ( site, menu_id, page_count) VALUES ('" . SITE_NAME . "', $menuID, 1 ) ";
        $DB->runQuery($query);
    }
    ?>
