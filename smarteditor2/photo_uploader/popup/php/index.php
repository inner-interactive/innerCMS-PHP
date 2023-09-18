<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
include_once("./_common.php");
@include_once("./JSON.php");

//플러그인 폴더 이름 및 스킨 폴더 이름
define('SMARTEDITOR_UPLOAD_IMG_CHECK', 1);  // 이미지 파일을 썸네일 할수 있는지 여부를 체크합니다. ( 해당 파일이 이미지 파일인지 체크합니다. 1이면 사용, 0이면 사용 안함 )
define('SMARTEDITOR_UPLOAD_RESIZE', 0);  // 스마트에디터 업로드 이미지파일 JPG, PNG 리사이즈 1이면 사용, 0이면 사용안함
define('SMARTEDITOR_UPLOAD_MAX_WIDTH', 1200);  // 스마트에디터 업로드 이미지 리사이즈 제한 width
define('SMARTEDITOR_UPLOAD_MAX_HEIGHT', 2800);  // 스마트에디터 업로드 이미지 리사이즈 제한 height
define('SMARTEDITOR_UPLOAD_SIZE_LIMIT', 20);  // 스마트에디터 업로드 사이즈 제한 ( 기본 20MB )
define('SMARTEDITOR_UPLOAD_IMAGE_QUALITY', 98);  // 썸네일 이미지 JPG, PNG 압축률

if( !function_exists('json_encode') ) {
    function json_encode($data) {
        $json = new Services_JSON();
        return( $json->encode($data) );
    }
}

@ini_set('gd.jpeg_ignore_warning', 1);

// $ym = date('ym', time());

$data_dir = DATA_PATH.'editor/';
$data_url = DATA_URL.'editor/';

// mkdir($data_dir, 0755);
// @chmod($data_dir, 0755);

if(!function_exists('ft_nonce_is_valid')){
    include_once(COMMON_PATH.'lib/editor.lib.php');
}

$is_editor_upload = false;

if( isset($_GET['_nonce']) && ft_nonce_is_valid( $_GET['_nonce'] , 'smarteditor' ) ){
    $is_editor_upload = true;
}

if( $is_editor_upload ) {

    require('UploadHandler.php');
    $options = array(
        'upload_dir' => $data_dir,
        'upload_url' => $data_url,
        // This option will disable creating thumbnail images and will not create that extra folder.
        // However, due to this, the images preview will not be displayed after upload
        'image_versions' => array()
    );

    $upload_handler = new UploadHandler($options);

} else {
    echo json_encode(array('files'=>array('0'=>array('error'=>'정상적인 업로드가 아닙니다.'))));
    exit;
}