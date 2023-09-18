<?php

//innerCMS 상위 메뉴 등록
$q = "SELECT count(*) FROM `menuinfo`";
$DB->getDBData($q);
$dbData = $DB->getDBData($q);
$count = intval($dbData[0][0]);
if($count > 0) return;	//menuinfo 테이블에 등록된 데이터가 있으면 스킵

$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 24, 'innerCMS', 'member', '회원관리', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 2, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'innerCMS', 'menuinfo', '메뉴관리', 'sub_body.php', 1, 0, 0, 0, 'skin', '', 0, 'S', 3, 'common', 'menuinfo', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'innerCMS', 'login', '로그인', 'login_body.php', 1, 1, 1, 1, 'skin', '', 0, 'S', 9, 'member', 'login', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 316, 'innerCMS', 'statistics', '통계관리', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 8, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'innerCMS', 'org', '조직도관리', 'sub_body.php', 1, 0, 0, 1, 'skin', '', 0, 'S', 7, 'common', 'orginfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'innerCMS', 'banner', '배너관리', 'sub_body.php', 1, 0, 0, 0, 'skin', '', 0, 'S', 6, 'common', 'banner', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'innerCMS', 'popup', '팝업관리', 'sub_body.php', 1, 0, 0, 0, 'skin', '', 0, 'S', 5, 'common', 'popup', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 330, 'innerCMS', 'site', '사이트관리', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 1, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'innerCMS', 'contents', '소스관리', 'sub_body.php', 1, 0, 0, 0, 'skin', '', 0, 'S', 4, 'common', 'contents', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')"
);

foreach($q as $v){
    $DB->runQuery($v);
}


//사이트관리 설정
$q = "SELECT menu_id FROM `menuinfo` WHERE site = 'innerCMS' AND route = 'site'";
$dbData = $DB->getDBData($q);
$parent_id = intval($dbData[0]['menu_id']);

$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '사이트정보', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 1, 'common', 'siteinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '스팸 필터', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 2, 'common', 'spaminfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')");
foreach($q as $v){
    $DB->runQuery($v);
}

$q = "SELECT menu_id FROM `menuinfo` WHERE parent_id = $parent_id AND menu_order = 1";
$dbData = $DB->getDBData($q);
$second_id = intval($dbData[0]['menu_id']);

$q = "UPDATE `menuinfo` SET second_id = ".$second_id." WHERE menu_id = ".$parent_id;
$DB->runQuery($q);


//회원관리 설정
$q = "SELECT menu_id FROM `menuinfo` WHERE site = 'innerCMS' AND route = 'member'";
$dbData = $DB->getDBData($q);
$parent_id = intval($dbData[0]['menu_id']);

$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', 'memberinfo', '회원정보', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 1, 'member', 'memberinfo', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '회원권한관리', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 2, 'member', 'groupinfo', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 90, 90, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '블랙리스트', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 3, 'member', 'blacklist', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '탈퇴회원 정보', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 4, 'member', 'retireinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '최근 로그인 사용자', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 5, 'member', 'recentlogin', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'innerCMS', NULL, '최근 가입 회원', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 6, 'member', 'recentjoin', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')"
);

foreach($q as $v){
    $DB->runQuery($v);
}

$q = "SELECT menu_id FROM `menuinfo` WHERE parent_id = $parent_id AND menu_order = 1";
$dbData = $DB->getDBData($q);
$second_id = intval($dbData[0]['menu_id']);

$q = "UPDATE `menuinfo` SET second_id = ".$second_id." WHERE menu_id = ".$parent_id;
$DB->runQuery($q);



//통계관리 설정 (2차, 3차 메뉴 등록)
$q = "SELECT menu_id FROM `menuinfo` WHERE site = 'innerCMS' AND route = 'statistics'";
$dbData = $DB->getDBData($q);
$rank1_parent_id = intval($dbData[0]['menu_id']);

$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank1_parent_id}, 316, 'innerCMS', NULL, '접속자통계', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 1, 'visit', 'visitinfo', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank1_parent_id}, 0, 'innerCMS', NULL, '페이지뷰', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 2, 'visit', 'pageview', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')"
);

foreach($q as $v){
    $DB->runQuery($v);
}


//2차 첫번째 메뉴 메뉴 아이디값 구하기
$q = "SELECT menu_id FROM `menuinfo` WHERE parent_id = $rank1_parent_id AND rank = 2 AND menu_order = 1";
$dbData = $DB->getDBData($q);
$rank2_parent_id = intval($dbData[0]['menu_id']);
$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'visitor', '접속자', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 1, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'domain', '도메인', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 2, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'browser', '브라우저', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 3, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'os', '운영체제', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 4, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'device', '접속기기', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 5, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'hour', '시간', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 6, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'week', '요일', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 7, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'date', '일', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 8, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'month', '월', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 9, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$rank2_parent_id}, 0, 'innerCMS', 'year', '년', 'sub_body.php', 3, 0, 0, 0, 'skin', '', 0, 'S', 10, 'visit', 'visitinfo', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, '', '')"
);


foreach($q as $v){
    $DB->runQuery($v);
}


$q = "SELECT menu_id FROM `menuinfo` WHERE parent_id = $rank2_parent_id AND rank = 3 AND menu_order = 1";
$dbData = $DB->getDBData($q);
$second_id = intval($dbData[0]['menu_id']);

$q = "UPDATE `menuinfo` SET second_id = ".$second_id." WHERE menu_id = $rank1_parent_id OR menu_id = $rank2_parent_id";
$DB->runQuery($q);




//메인 사이트 설정
$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 7, 'main', 'member', '회원메뉴', 'sub_body.php', 1, 1, 1, 1, 'contents', '', 0, 'S', 1, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', 'search', '통합검색', 'sub_body.php', 1, 1, 1, 1, 'skin', '', 0, 'S', 2, 'common', 'search', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 99, 99, 99, 99, 99, 99, 99, 0, 99, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', 'sitemap', '사이트맵', 'sub_body_1300.php', 1, 1, 1, 1, 'contents', '', 1, 'S', 8, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')"
);

foreach($q as $v){
    $DB->runQuery($v);
}

//회원 메뉴 하위 메뉴 등록
$q = "SELECT menu_id FROM `menuinfo` WHERE site = 'main' AND route = 'member'";
$dbData = $DB->getDBData($q);
$parent_id = intval($dbData[0]['menu_id']);

$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'main', 'login', '로그인', 'sub_body.php', 2, 1, 1, 1, 'skin', '', 0, 'S', 1, 'member', 'login', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'main', 'join', '회원가입', 'sub_body.php', 2, 1, 1, 1, 'skin', '', 0, 'S', 2, 'member', 'join', '', '', 0, 0, 0, '', 0, 'MB', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'main', 'idpw', '아이디 / 비밀번호 찾기', 'sub_body.php', 2, 0, 0, 0, 'skin', '', 0, 'S', 5, 'member', 'idpw', '', '', 10, 0, 2, '', 10, 'MB', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'main', 'private', '개인정보처리방침', 'sub_body.php', 2, 1, 1, 1, 'contents', '', 1, 'S', 3, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'main', 'stipul', '이용약관', 'sub_body.php', 2, 0, 1, 1, 'contents', '', 1, 'S', 4, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')"
);

foreach($q as $v){
    $DB->runQuery($v);
}

$q = "SELECT menu_id FROM `menuinfo` WHERE parent_id = $parent_id AND menu_order = 1";
$dbData = $DB->getDBData($q);
$second_id = intval($dbData[0]['menu_id']);

$q = "UPDATE `menuinfo` SET second_id = ".$second_id." WHERE menu_id = ".$parent_id;
$DB->runQuery($q);



//기본 메뉴 설정
$q = array(
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', NULL, '메뉴1', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 3, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', NULL, '메뉴2', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 4, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', NULL, '메뉴3', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 5, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', NULL, '메뉴4', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 6, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')",
    "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES (0, 0, 'main', NULL, '메뉴5', 'sub_body.php', 1, 0, 0, 0, 'contents', '', 0, 'S', 7, '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')"
);

foreach($q as $v){
    $DB->runQuery($v);
}

for($i = 0; $i < 5; $i++){
    
    $q = "SELECT menu_id FROM `menuinfo` WHERE site = 'main' AND rank = 1 AND menu_order = ".($i+3);
    $dbData = $DB->getDBData($q);
    $parent_id = intval($dbData[0]['menu_id']);
    
    
    for($j = 0; $j < 5; $j++){
        $q = "INSERT INTO `menuinfo` (`parent_id`, `second_id`, `site`, `route`, `menu_title`, `bodyfile`, `rank`, `menu_hide1`, `menu_hide2`, `menu_hide3`, `menu_type`, `href`, `use_file`, `target`, `menu_order`, `skin_group`, `skin`, `skin_header`, `skin_tail`, `list_limit_num`, `subject_limit_num`, `html_use`, `upload_ext`, `upload_size`, `upload_unit`, `thumb_size`, `category_use`, `comment_use`, `category_list`, `auth_list`, `auth_view`, `auth_write`, `auth_comment`, `auth_reply`, `auth_alltag`, `auth_gongji`, `auth_secret`, `auth_fileup`, `auth_filedown`, `auth_admin`, `db_table`, `db_table2`) VALUES ({$parent_id}, 0, 'main', NULL, '메뉴".($i+1)."-".($j+1)."', 'sub_body.php', 2, 0, 0, 0, 'contents', '', 0, 'S', ".($j+1).", '', '', '', '', 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '')";
        $DB->runQuery($q);
        
        if($j == 0){
            $q = "SELECT menu_id FROM `menuinfo` WHERE parent_id = $parent_id AND menu_order = 1";
            $dbData = $DB->getDBData($q);
            $second_id = intval($dbData[0]['menu_id']);
            
            $q = "UPDATE `menuinfo` SET second_id = ".$second_id." WHERE menu_id = ".$parent_id;
            $DB->runQuery($q);
        }
    }
    
}

