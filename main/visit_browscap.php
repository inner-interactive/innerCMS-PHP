<?php
if (! defined('BASE_PATH'))
    exit(); // 개별 페이지 접근 불가

if (! (version_compare(phpversion(), '5.3.0', '>=') && defined('BROWSCAP_USE') && BROWSCAP_USE))
    return;

// Browscap 캐시 파일이 있으면 실행
if (defined('VISIT_BROWSCAP_USE') && VISIT_BROWSCAP_USE) {
    // if(defined('VISIT_BROWSCAP_USE') && VISIT_BROWSCAP_USE ) {
    // ini_set('memory_limit','-1');
    include_once (COMMON_PATH . 'plugin/browscap/Browscap.php');

    $browscap = new phpbrowscap\Browscap(DATA_PATH . '/cache');
    $browscap->doAutoUpdate = false;
    $browscap->cacheFilename = 'browscap_cache.php';

    $info = $browscap->getBrowser($_SERVER['HTTP_USER_AGENT']);

    $vi_browser = $info->Comment;
    $vi_os = $info->Platform;
    $vi_device = $info->Device_Type;
}
?>