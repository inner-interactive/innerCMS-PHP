CREATE TABLE IF NOT EXISTS `fileinfo` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '첨부파일 코드',
  `menu_id` int(11) DEFAULT NULL COMMENT '메뉴 코드',
  `indexcode` int(11) DEFAULT NULL COMMENT '게시물 번호',
  `attach_type` varchar(50) DEFAULT NULL COMMENT '첨부파일 타입( cover : 대표이미지, pic : 첨부이미지)',
  `attach_file_name` varchar(500) DEFAULT NULL COMMENT '첨부파일명',
  `down_file_name` varchar(500) DEFAULT NULL COMMENT '다운로드파일명',
  `file_size` int(11) DEFAULT NULL COMMENT '파일크기',
  `file_ext` varchar(50) DEFAULT NULL COMMENT '파일확장자',
  `file_down_count` int(11) DEFAULT '0' COMMENT '파일다운로드수',
  `writetime` datetime DEFAULT NULL COMMENT '등록시간',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip주소',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='첨부파일 테이블';


CREATE TABLE IF NOT EXISTS  `filelog` (
	`log_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '로그코드',
	`query` TEXT NULL DEFAULT NULL COMMENT '실행쿼리' COLLATE 'utf8_general_ci',
	`menu_id` INT(11) NULL DEFAULT NULL,
	`writetime` DATETIME NULL DEFAULT NULL COMMENT '등록시간',
	`ip` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ip주소' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`log_id`) USING BTREE
)
COMMENT='첨부파일 등록/삭제 이력 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC;



CREATE TABLE IF NOT EXISTS `groupinfo` (
  `indexcode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '권한명',
  `groupname` varchar(100) DEFAULT NULL COMMENT '그룹명',
  `authlevel` smallint(6) NOT NULL COMMENT '그룹레벨값',
  PRIMARY KEY (`indexcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='권한그룹 테이블';



INSERT INTO `groupinfo` (`indexcode`, `name`, `groupname`, `authlevel`) VALUES
	(1, '최고관리자', '관리자그룹', 99),
	(2, '일반관리자', '관리자그룹', 90),
	(3, '일반회원', '일반회원그룹', 10),
	(4, '비로그인 사용자', '비회원그룹', 0);


CREATE TABLE `complain` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT COMMENT '인덱스코드',
	`menu_id` INT(11) NULL DEFAULT NULL COMMENT '메뉴값',
	`site` VARCHAR(50) NULL DEFAULT NULL COMMENT '사이트명' COLLATE 'utf8_general_ci',
	`uid` VARCHAR(50) NULL DEFAULT NULL COMMENT '작성자 아이디' COLLATE 'utf8_general_ci',
	`uname` VARCHAR(50) NULL DEFAULT NULL COMMENT '작성자 이름' COLLATE 'utf8_general_ci',
	`complain` TEXT NULL DEFAULT NULL COMMENT '민원 사항' COLLATE 'utf8_general_ci',
	`point` TINYINT(4) NULL DEFAULT NULL COMMENT '만족도 ( 1 : 매우불만족, 2 : 불만족, 3 : 보통, 4 : 만족, 5 : 매우만족 )',
	`writetime` DATETIME NULL DEFAULT NULL COMMENT '작성시간',
	`ip` VARCHAR(50) NULL DEFAULT NULL COMMENT '작성자 아이피주소' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`indexcode`) USING BTREE
)
COMMENT='민원 사항 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
;


CREATE TABLE `contents` (
	`content_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '컨텐츠코드',
	`menu_id` INT(11) NOT NULL COMMENT '메뉴코드',
	`uid` VARCHAR(100) NOT NULL COMMENT '작성자 아이디' COLLATE 'utf8_general_ci',
	`site` VARCHAR(100) NOT NULL COMMENT '사이트명' COLLATE 'utf8_general_ci',
	`isapply` TINYINT(4) NOT NULL COMMENT '컨텐츠 적용 여부',
	`contents` MEDIUMTEXT NOT NULL COMMENT '컨텐츠 내용' COLLATE 'utf8_general_ci',
	`writetime` DATETIME NOT NULL COMMENT '컨텐츠 수정시간',
	`ip` VARCHAR(100) NOT NULL COMMENT '작성자 IP' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`content_id`) USING BTREE
)
COMMENT='컨텐츠 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=COMPACT
;

CREATE TABLE `logininfo` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT,
	`userid` VARCHAR(45) NULL DEFAULT NULL COMMENT '아이디' COLLATE 'utf8_general_ci',
	`logintime` DATETIME NULL DEFAULT NULL COMMENT '로그인시각',
	`ip` VARCHAR(20) NULL DEFAULT NULL COMMENT 'ip주소' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`indexcode`) USING BTREE
)
COMMENT='로그인 정보테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
;



CREATE TABLE IF NOT EXISTS `memberinfo` (
  `indexcode` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(45) NOT NULL DEFAULT '' COMMENT '아이디',
  `userpw` varchar(45) NOT NULL DEFAULT '' COMMENT '패스워드',
  `authlevel` smallint(6) NOT NULL DEFAULT '900' COMMENT '권한',
  `realname` varchar(100) DEFAULT NULL COMMENT '실명',
  `nickname` varchar(100) DEFAULT NULL COMMENT '닉네임',
  `birth` date DEFAULT NULL COMMENT '생년월일',
  `sex` char(1) DEFAULT 'M' COMMENT '성별',
  `pic` varchar(100) DEFAULT NULL COMMENT '사용자 사진',
  `files` varchar(255) DEFAULT NULL COMMENT '첨부파일',
  `memo` text COMMENT '회원소개 내용',
  `phone` varchar(20) DEFAULT NULL COMMENT '연락처',
  `mobile` varchar(20) DEFAULT NULL COMMENT '휴대전화',
  `email` varchar(100) DEFAULT NULL COMMENT '이메일',
  `zipcode` varchar(100) DEFAULT NULL COMMENT '우편번호',
  `address` varchar(255) DEFAULT NULL COMMENT '기본주소',
  `address2` varchar(255) DEFAULT NULL COMMENT '상세주소',
  `address3` varchar(255) DEFAULT NULL COMMENT '참고항목',
  `address_type` char(1) DEFAULT NULL COMMENT '주소타입 (지번주소 : J , 도로명 주소 : R)',
  `url` varchar(255) DEFAULT NULL COMMENT '홈페이지/블로그 URL',
  `opt` tinyint(1) DEFAULT '0' COMMENT '회원분류번호',
  `category` varchar(45) DEFAULT NULL COMMENT '회원분류',
  `ismailing` enum('Y','N') DEFAULT 'N' COMMENT '메일링 유무',
  `jointype` varchar(20) DEFAULT NULL COMMENT '실명인증 타입',
  `jointime` datetime DEFAULT NULL COMMENT '가입 날짜',
  `lastlogintime` varchar(20) DEFAULT NULL COMMENT '최근 로그인 날짜',
  `isblocked` tinyint(1) DEFAULT '0' COMMENT '블랙리스트 유무',
  `blockedtime` varchar(20) DEFAULT NULL COMMENT '블랙리스트 제한 날짜',
  `etc` longtext COMMENT '부가정보',
  `docnum` int(11) DEFAULT '0' COMMENT '사용자 작성글 수',
  `cmtnum` int(11) DEFAULT '0' COMMENT '코멘트 작성글 수',
  `lognum` int(11) DEFAULT '0' COMMENT '로그인 횟수',
  PRIMARY KEY (`indexcode`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='회원정보 테이블';

INSERT INTO `memberinfo` (`indexcode`, `userid`, `userpw`, `authlevel`, `realname`, `nickname`, `birth`, `sex`, `pic`, `files`, `memo`, `phone`, `mobile`, `email`, `zipcode`, `address`, `address2`, `address3`, `address_type`, `url`, `opt`, `category`, `ismailing`, `jointype`, `jointime`, `lastlogintime`, `isblocked`, `blockedtime`, `etc`, `docnum`, `cmtnum`, `lognum`) VALUES
	(1, 'admin', '*6B087228A8639948EA7011454DEF29204036181A', 99, '관리자', '관리자', '2001-05-15', 'M', NULL, NULL, '사이트 관리자', '', '', '', '', '', '', '', '', '', 2, '관리자', 'N', 'ipin', '2001-05-15 10:00:00', '2019-03-26 10:07:42', 0, NULL, '', 0, 0, 14),
	(2, 'inner', '*6B087228A8639948EA7011454DEF29204036181A', 99, '관리자2', '관리자2', '2001-05-15', 'M', NULL, NULL, '이너인터랙티브 관리자', '063-246-0515', '010-8649-2319', 'cs@inner515.co.kr', '54858', '전라북도 전주시 덕진구 만성북로 21-26', '전북콘텐츠기업지원센터 310호', NULL, 'R', 'http://www.inner515.co.kr', 2, '관리자2', 'N', 'ipin', '2001-05-15 10:00:00', '2020-04-17 13:54:41', 0, '', '', 0, 0, 0);


CREATE TABLE `menuinfo` (
	`menu_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '메뉴코드',
	`parent_id` INT(11) NOT NULL DEFAULT '0' COMMENT '상위메뉴코드',
	`second_id` INT(11) NOT NULL DEFAULT '0' COMMENT '하위메뉴로 이동할 코드 값',
	`site` VARCHAR(100) NULL DEFAULT NULL COMMENT '사이트명' COLLATE 'utf8_general_ci',
	`route` VARCHAR(100) NULL DEFAULT NULL COMMENT '특정 메뉴를 찾는 키값' COLLATE 'utf8_general_ci',
	`menu_title` VARCHAR(255) NOT NULL COMMENT '메뉴타이틀' COLLATE 'utf8_general_ci',
	`bodyfile` VARCHAR(100) NOT NULL COMMENT '페이지 바디 파일' COLLATE 'utf8_general_ci',
	`rank` TINYINT(4) NOT NULL COMMENT '메뉴차수(1부터 시작)',
	`menu_hide1` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '메뉴숨김( gnb : 대메뉴)',
	`menu_hide2` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '메뉴숨김( sidebar : 사이드메뉴)',
	`menu_hide3` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '메뉴숨김( sitemap : 사이트맵)',
	`menu_type` VARCHAR(100) NOT NULL COMMENT '메뉴타입(contents, skin, link)' COLLATE 'utf8_general_ci',
	`href` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '메뉴타입이 link일 경우 이동할 url' COLLATE 'utf8_general_ci',
	`use_file` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '메뉴타입이 contents일 경우 파일 사용 여부',
	`target` ENUM('B','S') NOT NULL DEFAULT 'S' COMMENT '메뉴새창(S:현재창, B:새창)' COLLATE 'utf8_general_ci',
	`menu_order` SMALLINT(6) NOT NULL COMMENT '메뉴정렬순서(1부터 시작)',
	`skin_group` VARCHAR(100) NOT NULL COMMENT '스킨그룹' COLLATE 'utf8_general_ci',
	`skin` VARCHAR(100) NOT NULL COMMENT '스킨명' COLLATE 'utf8_general_ci',
	`skin_header` MEDIUMTEXT NOT NULL COMMENT '스킨상단내용' COLLATE 'utf8_general_ci',
	`skin_tail` MEDIUMTEXT NOT NULL COMMENT '스킨하단내용' COLLATE 'utf8_general_ci',
	`list_limit_num` SMALLINT(6) NOT NULL COMMENT '글목록제한수(기본10개)',
	`subject_limit_num` SMALLINT(6) NOT NULL COMMENT '글제목글자수제한',
	`html_use` TINYINT(4) NOT NULL COMMENT 'html 사용여부',
	`upload_ext` VARCHAR(100) NOT NULL COMMENT '업로드가능 확장자' COLLATE 'utf8_general_ci',
	`upload_size` INT(11) NOT NULL COMMENT '업로드 크기',
	`upload_unit` VARCHAR(100) NOT NULL COMMENT '업로드 단위(KB,MB,GB,TB)' COLLATE 'utf8_general_ci',
	`thumb_size` VARCHAR(100) NOT NULL COMMENT '섬네일사이즈' COLLATE 'utf8_general_ci',
	`category_use` TINYINT(4) NOT NULL COMMENT '카테고리 사용여부',
	`comment_use` TINYINT(4) NOT NULL COMMENT '코멘트 사용여부',
	`category_list` VARCHAR(255) NOT NULL COMMENT '카테고리 리스트' COLLATE 'utf8_general_ci',
	`auth_list` SMALLINT(6) NOT NULL COMMENT '리스트페이지 보기 권한',
	`auth_view` SMALLINT(6) NOT NULL COMMENT '뷰페이지 보기 권한',
	`auth_write` SMALLINT(6) NOT NULL COMMENT '글쓰기 권한',
	`auth_comment` SMALLINT(6) NOT NULL COMMENT '코멘트쓰기 권한',
	`auth_reply` SMALLINT(6) NOT NULL COMMENT '답글쓰기 권한',
	`auth_alltag` SMALLINT(6) NOT NULL COMMENT '모든태그 사용 권한',
	`auth_gongji` SMALLINT(6) NOT NULL COMMENT '공지사항 입력 권한',
	`auth_secret` SMALLINT(6) NOT NULL COMMENT '비밀글 입력 권한',
	`auth_fileup` SMALLINT(6) NOT NULL COMMENT '파일 업로드 권한',
	`auth_filedown` SMALLINT(6) NOT NULL COMMENT '파일 다운로드 권한',
	`auth_admin` SMALLINT(6) NOT NULL COMMENT '관리기능 사용 권한',
	`db_table` VARCHAR(100) NOT NULL COMMENT '게시판 테이블명' COLLATE 'utf8_general_ci',
	`db_table2` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`menu_id`) USING BTREE,
	UNIQUE INDEX `인덱스 2` (`site`, `route`) USING BTREE
)
COMMENT='메뉴 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1
;



CREATE TABLE `organization` (
	`org_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '기관(조직) 인덱스값',
	`org_code` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`org_depth` INT(11) NULL DEFAULT '0' COMMENT '카테고리 단계 (0 ~ )',
	`org_sort` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '카테고리 정렬 값 (1 ~ )',
	`org_parent` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '부모 카테고리의 인덱스 값',
	`menu_id` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '메뉴에 연동할 id값',
	`org_type` VARCHAR(25) NULL DEFAULT NULL COMMENT 'team or member' COLLATE 'utf8_general_ci',
	`org_name` VARCHAR(50) NULL DEFAULT NULL COMMENT '기관(조직)명' COLLATE 'utf8_general_ci',
	`name` VARCHAR(50) NULL DEFAULT NULL COMMENT '성명' COLLATE 'utf8_general_ci',
	`position` VARCHAR(50) NULL DEFAULT NULL COMMENT '직위(직급)' COLLATE 'utf8_general_ci',
	`email` VARCHAR(50) NULL DEFAULT NULL COMMENT '이메일주소' COLLATE 'utf8_general_ci',
	`tel` VARCHAR(50) NULL DEFAULT NULL COMMENT '사무실 전화번호' COLLATE 'utf8_general_ci',
	`work` VARCHAR(255) NULL DEFAULT NULL COMMENT '담당업무' COLLATE 'utf8_general_ci',
	`ip` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`writetime` DATETIME NULL DEFAULT NULL,
	`updatetime` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`org_id`) USING BTREE
)
COMMENT='기관(조직도) 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1
;


CREATE TABLE IF NOT EXISTS `popup` (
  `pop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '팝업 코드',
  `site` varchar(100) DEFAULT NULL COMMENT '사이트',
  `uid` varchar(100) DEFAULT NULL,
  `uname` varchar(100) DEFAULT NULL,
  `pop_type` varchar(100) DEFAULT NULL COMMENT '팝업방식 (새창 : popup, 레이어 : layer)',
  `subject` varchar(500) DEFAULT NULL COMMENT '팝업제목',
  `start_date` date DEFAULT NULL COMMENT '팝업시작날짜',
  `end_date` date DEFAULT NULL COMMENT '팝업종료날짜',
  `width` smallint(6) DEFAULT NULL COMMENT '팝업 가로사이즈',
  `height` smallint(6) DEFAULT NULL COMMENT '팝업 세로사이즈',
  `left` smallint(6) DEFAULT NULL COMMENT '팝업창 위치 좌측에서부터',
  `top` smallint(6) DEFAULT NULL COMMENT '팝업창 위치 상단에서부터',
  `not_today` tinyint(4) DEFAULT NULL COMMENT '오늘은 이창을 다시 열지 않음',
  `subject_display` tinyint(4) DEFAULT NULL COMMENT '제목표시',
  `isstop` tinyint(4) DEFAULT NULL COMMENT '팝업중지',
  `link_target` enum('B','S') DEFAULT 'S' COMMENT '팝업내용 링크 대상 ( B : 새창, S : 현재창)',
  `memo` mediumtext COMMENT '팝업내용',
  `writetime` datetime DEFAULT NULL COMMENT '등록시간',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip주소',
  `f1` VARCHAR(255) NULL DEFAULT NULL COMMENT '팝업링크' COLLATE 'utf8_general_ci',
  PRIMARY KEY (`pop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='팝업 테이블';

CREATE TABLE IF NOT EXISTS `retireinfo` (
  `indexcode` int(11) NOT NULL AUTO_INCREMENT,
  `retiretime` datetime DEFAULT NULL COMMENT '탈퇴 날짜',
  `userid` varchar(45) NOT NULL DEFAULT '' COMMENT '아이디',
  `authlevel` smallint(6) NOT NULL DEFAULT '900' COMMENT '권한',
  `nickname` varchar(100) DEFAULT NULL COMMENT '닉네임',
  `realname` varchar(100) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL COMMENT '성별',
  `category` varchar(45) DEFAULT NULL COMMENT '회원분류',
  `jointype` varchar(20) DEFAULT NULL COMMENT '실명인증 타입',
  `jointime` varchar(20) DEFAULT NULL COMMENT '가입 날짜',
  `lastlogintime` varchar(20) DEFAULT NULL COMMENT '최근 로그인 날짜',
  `isblocked` tinyint(1) DEFAULT '0' COMMENT '블랙리스트 유무',
  `blockedtime` varchar(20) DEFAULT NULL COMMENT '블랙리스트 제한 날짜',
  `etc` longtext COMMENT '부가정보',
  `docnum` int(11) DEFAULT '0' COMMENT '사용자 작성글 수',
  `cmtnum` int(11) DEFAULT '0' COMMENT '코멘트 작성글 수',
  `lognum` int(11) DEFAULT '0' COMMENT '로그인 횟수',
  PRIMARY KEY (`indexcode`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='탈퇴회원정보 테이블';


CREATE TABLE IF NOT EXISTS `banner` (
	`banner_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '팝업 코드',
	`site` VARCHAR(100) NULL DEFAULT NULL COMMENT '사이트' COLLATE 'utf8_general_ci',
	`banner_type` VARCHAR(100) NULL DEFAULT NULL COMMENT '배너종류' COLLATE 'utf8_general_ci',
	`uid` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`uname` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`title` VARCHAR(500) NULL DEFAULT NULL COMMENT '배너제목' COLLATE 'utf8_general_ci',
	`subtitle` VARCHAR(500) NULL DEFAULT NULL COMMENT '배너소제목' COLLATE 'utf8_general_ci',
	`link` VARCHAR(500) NULL DEFAULT NULL COMMENT '배너링크' COLLATE 'utf8_general_ci',
	`memo` MEDIUMTEXT NULL DEFAULT NULL COMMENT '배너내용' COLLATE 'utf8_general_ci',
	`start_date` DATE NULL DEFAULT NULL COMMENT '배너시작날짜',
	`end_date` DATE NULL DEFAULT NULL COMMENT '배너종료날짜',
	`sort` TINYINT(4) NULL DEFAULT NULL COMMENT '정렬순서',
	`isstop` TINYINT(4) NULL DEFAULT NULL COMMENT '배너중지',
	`link_target` ENUM('B','S') NULL DEFAULT 'S' COMMENT '배너내용 링크 대상 ( B : 새창, S : 현재창)' COLLATE 'utf8_general_ci',
	`writetime` DATETIME NULL DEFAULT NULL COMMENT '등록시간',
	`ip` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ip주소' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`banner_id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC COMMENT='배너 테이블';


CREATE TABLE IF NOT EXISTS `visit` (
	`vi_id` INT(11) NOT NULL AUTO_INCREMENT,
	`site` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`vi_ip` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`vi_date` DATE NOT NULL DEFAULT '0000-00-00',
	`vi_time` TIME NOT NULL DEFAULT '00:00:00',
	`vi_referer` TEXT NOT NULL COLLATE 'utf8_general_ci',
	`vi_agent` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`vi_browser` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`vi_os` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`vi_device` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`vi_id`) USING BTREE,
	UNIQUE INDEX `index1` (`site`, `vi_ip`, `vi_date`) USING BTREE,
	INDEX `index2` (`vi_date`) USING BTREE
)
COMMENT='접속자 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM;



CREATE TABLE IF NOT EXISTS  `visit_pageview` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT,
	`site` VARCHAR(20) NULL DEFAULT NULL COMMENT '사이트키' COLLATE 'utf8_general_ci',
	`menu_id` INT(11) NULL DEFAULT NULL COMMENT '메뉴코드',
	`page_count` BIGINT(10) NULL DEFAULT '0' COMMENT '조회수',
	PRIMARY KEY (`indexcode`) USING BTREE,
	UNIQUE INDEX `index` (`site`, `menu_id`) USING BTREE
)
COMMENT='페이지뷰 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC;



CREATE TABLE IF NOT EXISTS `visit_sum` (
	`vs_id` INT(11) NOT NULL AUTO_INCREMENT,
	`vs_date` DATE NOT NULL DEFAULT '0000-00-00',
	`site` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`vs_count` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`vs_id`) USING BTREE,
	UNIQUE INDEX `index2` (`vs_date`, `site`) USING BTREE,
	INDEX `index1` (`vs_count`) USING BTREE
)
COMMENT='접속자 합계 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM;



CREATE TABLE `program` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT,
	`delflag` TINYINT(1) NULL DEFAULT '0' COMMENT '글삭제 유무(복구기능)',
	`uid` VARCHAR(100) NULL DEFAULT NULL COMMENT '사용자 아이디' COLLATE 'utf8_general_ci',
	`upw` VARCHAR(255) NULL DEFAULT NULL COMMENT '사용자 패스워드' COLLATE 'utf8_general_ci',
	`uname` VARCHAR(100) NULL DEFAULT NULL COMMENT '사용자 이름' COLLATE 'utf8_general_ci',
	`subject` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '프로그램명' COLLATE 'utf8_general_ci',
	`memo` MEDIUMTEXT NULL DEFAULT NULL COMMENT '프로그램내용' COLLATE 'utf8_general_ci',
	`view` INT(11) NULL DEFAULT '0',
	`status` TINYINT(1) NULL DEFAULT '0' COMMENT '게시물 상태',
	`ip` VARCHAR(20) NULL DEFAULT NULL COMMENT '글작성 아이피 주소' COLLATE 'utf8_general_ci',
	`isimportant` TINYINT(1) NULL DEFAULT '0' COMMENT '공지사항 유무',
	`issecret` TINYINT(1) NULL DEFAULT '0' COMMENT '비밀글 유무',
	`category` VARCHAR(45) NULL DEFAULT NULL COMMENT '카테고리' COLLATE 'utf8_general_ci',
	`voted` SMALLINT(6) NULL DEFAULT NULL COMMENT '추천수',
	`hmode` TINYINT(3) NULL DEFAULT '0' COMMENT 'html Mode (0:허용안함 1:부분허용 2:모두허용)',
	`etc` MEDIUMTEXT NULL DEFAULT NULL COMMENT '기타' COLLATE 'utf8_general_ci',
	`origntime` VARCHAR(40) NULL DEFAULT NULL COMMENT '원본 글의 작성 시간 (관리자기능:복사)' COLLATE 'utf8_general_ci',
	`writetime` DATETIME NULL DEFAULT NULL COMMENT '글작성 시간',
	`updatetime` DATETIME NULL DEFAULT NULL COMMENT '글수정 시간',
	`replyfrom` INT(11) NULL DEFAULT '0' COMMENT '답글 번호',
	`replyrank` SMALLINT(6) NULL DEFAULT '0' COMMENT '글작성 rank',
	`replytime` VARCHAR(50) NULL DEFAULT NULL COMMENT '답글작성시간' COLLATE 'utf8_general_ci',
	`replyorder` INT(11) NULL DEFAULT '0' COMMENT '답글 소트 번호',
	`iscomment` TINYINT(4) NULL DEFAULT '0' COMMENT '코멘트 게시글 여부',
	`parentcode` INT(11) NULL DEFAULT '0' COMMENT '코멘트가 달린 원본 게시물 코드',
	`commentrank` SMALLINT(6) NULL DEFAULT '0' COMMENT '코멘트차수',
	`commentgroup` SMALLINT(6) NULL DEFAULT '0' COMMENT '코멘트그룹값',
	`commentorder` SMALLINT(6) NULL DEFAULT '0' COMMENT '코멘트정렬순서',
	`f1` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목1' COLLATE 'utf8_general_ci',
	`f2` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목7' COLLATE 'utf8_general_ci',
	`f3` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목6' COLLATE 'utf8_general_ci',
	`f4` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목8' COLLATE 'utf8_general_ci',
	`f5` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목5' COLLATE 'utf8_general_ci',
	`f6` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목3' COLLATE 'utf8_general_ci',
	`f7` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목2' COLLATE 'utf8_general_ci',
	`f8` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목4' COLLATE 'utf8_general_ci',
	`f9` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목9' COLLATE 'utf8_general_ci',
	`f10` VARCHAR(255) NULL DEFAULT NULL COMMENT '추가항목10' COLLATE 'utf8_general_ci',
	`ptype` TINYINT(4) NULL DEFAULT NULL COMMENT '진행기간 입력 타입(0 : 날짜 입력, 1 : 텍스트 입력)',
	`ptext` VARCHAR(255) NULL DEFAULT NULL COMMENT '진행기간 텍스트' COLLATE 'utf8_general_ci',
	`date1` DATE NULL DEFAULT NULL COMMENT '진행기간 시작 날짜',
	`date2` DATE NULL DEFAULT NULL COMMENT '진행기간 종료 날짜',
	`datetime1` DATETIME NULL DEFAULT NULL COMMENT '접수기간 시작',
	`datetime2` DATETIME NULL DEFAULT NULL COMMENT '접수기간 종료',
	`total` INT(11) NULL DEFAULT NULL COMMENT '프로그램정원',
	`site_menuid` INT(11) NULL DEFAULT NULL COMMENT '사이트 메뉴 id 값',
	`num5` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '숫자여분필드5',
	PRIMARY KEY (`indexcode`) USING BTREE
)
COMMENT='프로그램 목록 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM;

CREATE TABLE `program_apply` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT,
	`delflag` TINYINT(1) NULL DEFAULT '0' COMMENT '글삭제 유무(복구기능)',
	`programcode` INT(11) NULL DEFAULT '0',
	`menucode` INT(11) NULL DEFAULT '0',
	`uid` VARCHAR(100) NULL DEFAULT NULL COMMENT '사용자 아이디' COLLATE 'utf8_general_ci',
	`upw` VARCHAR(255) NULL DEFAULT NULL COMMENT '사용자 패스워드' COLLATE 'utf8_general_ci',
	`name` VARCHAR(100) NULL DEFAULT NULL COMMENT '신청자이름' COLLATE 'utf8_general_ci',
	`phone` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '핸드폰' COLLATE 'utf8_general_ci',
	`email` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '이메일' COLLATE 'utf8_general_ci',
	`total` SMALLINT(6) NULL DEFAULT NULL COMMENT '참여인원',
	`status` TINYINT(1) NULL DEFAULT '0' COMMENT '신청상태( 0 : 미승인, 1 : 승인)',
	`ip` VARCHAR(20) NULL DEFAULT NULL COMMENT '글작성 아이피 주소' COLLATE 'utf8_general_ci',
	`isimportant` TINYINT(1) NULL DEFAULT '0' COMMENT '공지사항 유무',
	`issecret` TINYINT(1) NULL DEFAULT '0' COMMENT '비밀글 유무',
	`category` VARCHAR(45) NULL DEFAULT NULL COMMENT '카테고리' COLLATE 'utf8_general_ci',
	`voted` SMALLINT(6) NULL DEFAULT NULL COMMENT '추천수',
	`hmode` TINYINT(3) NULL DEFAULT '0' COMMENT 'html Mode (0:허용안함 1:부분허용 2:모두허용)',
	`etc` MEDIUMTEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`origntime` VARCHAR(40) NULL DEFAULT NULL COMMENT '원본 글의 작성 시간 (관리자기능:복사)' COLLATE 'utf8_general_ci',
	`writetime` DATETIME NULL DEFAULT NULL COMMENT '글작성 시간',
	`updatetime` DATETIME NULL DEFAULT NULL COMMENT '글수정 시간',
	`replyfrom` INT(11) NULL DEFAULT '0' COMMENT '답글 번호',
	`replyrank` SMALLINT(6) NULL DEFAULT '0' COMMENT '글작성 rank',
	`replytime` VARCHAR(50) NULL DEFAULT NULL COMMENT '답글작성시간' COLLATE 'utf8_general_ci',
	`replyorder` INT(11) NULL DEFAULT '0' COMMENT '답글 소트 번호',
	`iscomment` TINYINT(4) NULL DEFAULT '0' COMMENT '코멘트 게시글 여부',
	`commentrank` SMALLINT(6) NULL DEFAULT '0' COMMENT '코멘트차수',
	`commentgroup` SMALLINT(6) NULL DEFAULT '0' COMMENT '코멘트그룹값',
	`commentorder` SMALLINT(6) NULL DEFAULT '0' COMMENT '코멘트정렬순서',
	`f1` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드1' COLLATE 'utf8_general_ci',
	`f2` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드2' COLLATE 'utf8_general_ci',
	`f3` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드3' COLLATE 'utf8_general_ci',
	`f4` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드4' COLLATE 'utf8_general_ci',
	`f5` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드5' COLLATE 'utf8_general_ci',
	`f6` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드6' COLLATE 'utf8_general_ci',
	`f7` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드7' COLLATE 'utf8_general_ci',
	`f8` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드8' COLLATE 'utf8_general_ci',
	`f9` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드9' COLLATE 'utf8_general_ci',
	`f10` VARCHAR(255) NULL DEFAULT NULL COMMENT '여분필드10' COLLATE 'utf8_general_ci',
	`date1` DATE NULL DEFAULT NULL COMMENT '날짜여분필드1',
	`date2` DATE NULL DEFAULT NULL COMMENT '날짜여분필드2',
	`num1` INT(11) NULL DEFAULT NULL COMMENT '참여인원수',
	`num2` INT(11) NULL DEFAULT NULL COMMENT '숫자여분필드2',
	`num3` INT(11) NULL DEFAULT NULL COMMENT '숫자여분필드3',
	`num4` INT(11) NULL DEFAULT NULL COMMENT '숫자여분필드4',
	`num5` INT(11) NULL DEFAULT NULL COMMENT '숫자여분필드5',
	PRIMARY KEY (`indexcode`) USING BTREE
)
COMMENT='프로그램 신청내역 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1;

CREATE TABLE `program_config` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT,
	`delflag` TINYINT(1) NULL DEFAULT '0' COMMENT '글삭제 유무(복구기능)',
	`uid` VARCHAR(100) NULL DEFAULT NULL COMMENT '사용자 아이디' COLLATE 'utf8_general_ci',
	`upw` VARCHAR(255) NULL DEFAULT NULL COMMENT '사용자 패스워드' COLLATE 'utf8_general_ci',
	`uname` VARCHAR(100) NULL DEFAULT NULL COMMENT '사용자 이름' COLLATE 'utf8_general_ci',
	`memo` MEDIUMTEXT NULL DEFAULT NULL COMMENT '소개' COLLATE 'utf8_general_ci',
	`site_menuid` INT(11) NULL DEFAULT '0',
	`admin_menuid` INT(11) NULL DEFAULT '0',
	`program_field_name` VARCHAR(255) NULL DEFAULT NULL COMMENT '프로그램 항목명' COLLATE 'utf8_general_ci',
	`program_field_use` VARCHAR(255) NULL DEFAULT NULL COMMENT '프로그랭 항목사용여부( 1 : 사용, 0 : 미사용)' COLLATE 'utf8_general_ci',
	`apply_field_name` VARCHAR(255) NULL DEFAULT NULL COMMENT '신청항목' COLLATE 'utf8_general_ci',
	`apply_field_use` VARCHAR(255) NULL DEFAULT NULL COMMENT '신청항목 사용여부( 1 : 사용, 0 : 미사용)' COLLATE 'utf8_general_ci',
	`finish_check_type` TINYINT(4) NULL DEFAULT NULL COMMENT '신청마감산정방식(0: 신청건수, 1:참여인원포함)',
	`reserv_check` TINYINT(4) NULL DEFAULT NULL COMMENT '신청 사용 여부(0:미사용, 1:사용)',
	`ip` VARCHAR(20) NULL DEFAULT NULL COMMENT '글작성 아이피 주소' COLLATE 'utf8_general_ci',
	`writetime` DATETIME NULL DEFAULT NULL COMMENT '날짜여분필드1',
	`updatetime` DATETIME NULL DEFAULT NULL COMMENT '날짜여분필드2',
	PRIMARY KEY (`indexcode`) USING BTREE
)
COMMENT='프로그램 설정 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1;

CREATE TABLE `search_history` (
	`indexcode` INT(11) NOT NULL AUTO_INCREMENT,
	`keyword` VARCHAR(255) NULL DEFAULT NULL COMMENT '검색 키워드' COLLATE 'utf8_general_ci',
	`count` INT(11) NULL DEFAULT NULL COMMENT '검색 수',
	`ip` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`writetime` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`indexcode`) USING BTREE
)
COMMENT='검색 이력 테이블'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
;
