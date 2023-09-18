<?php
include_once "../../../common.php";

function make_mp3()
{
    $number = $_SESSION["ss_captcha_key"];

    if ($number == "") return;
    if ($number == $_SESSION["ss_captcha_save"]) return;

    $mp3s = array();
    for($i=0;$i<strlen($number);$i++){
        $file = CAPTCHA_PATH.'/mp3/basic/'.$number[$i].'.mp3';
        $mp3s[] = $file;
    }

    $time = time();
    $ip = sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
    $mp3_file = 'cache/kcaptcha-'.$ip.'_'. $time.'.mp3';

    $contents = '';
    foreach ($mp3s as $mp3) {
        $contents .= file_get_contents($mp3);
    }

    file_put_contents(DATA_PATH.'/'.$mp3_file, $contents);

    // 지난 캡챠 파일 삭제
//  if (rand(0,99) == 0) {
    if (true) {
        foreach (glob(DATA_PATH.'cache/kcaptcha-*.mp3') as $file) {
            if (filemtime($file) + 86400 <  $time) {
                @unlink($file);
            }
        }
    }

    $_SESSION["ss_captcha_save"] =  $number;
    return '../data/'.$mp3_file;
}

echo make_mp3();
?>