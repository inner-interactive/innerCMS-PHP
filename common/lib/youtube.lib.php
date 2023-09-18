<?php

function youtubeUrlCheck ($url = '')
{
	$isUrlOk = false;
	
	if(strpos($url, "https://youtu.be/") !== false) {
		$isUrlOk = true;
	}
	return $isUrlOk;
}

/**
 * 유튜브 공유 url에서 videoID를 가져옴
 * 
 * @param string $url        	
 */
function getYoutubeVideoID ($url = '')
{
	$videoID = '';
	if($url != '') {
		$_url = str_replace("https://youtu.be/", "", $url);
		$tmp = explode("?", $_url);
		$videoID = $tmp[0];
	}
	
	return $videoID;
}

/**
 * 유튜브 동영상 재생 경로
 * https://www.youtube.com/embed/xxxxxxx
 * @param string $url
 */
function getYoutubeVideoSrc($url = ''){
	
	if(youtubeUrlCheck($url) == false) return null;
	return "https://www.youtube.com/embed/".getYoutubeVideoID($url);
}

/**
 * 유튜브 섬네일 url (high)
 * https://img.youtube.com/vi/xxxxxxx/hqdefault.jpg
 */
function getYoutubeThumbHigh($url = ''){
	if(youtubeUrlCheck($url) == false) return null;
	return "https://img.youtube.com/vi/".getYoutubeVideoID($url)."/hqdefault.jpg";
	
}

/**
 * 유튜브 섬네일 url (mideum)
 * https://img.youtube.com/vi/xxxxxxx/mqdefault.jpg
 */
function getYoutubeThumbMedium($url = ''){
	if(youtubeUrlCheck($url) == false) return null;
	return "https://img.youtube.com/vi/".getYoutubeVideoID($url)."/mqdefault.jpg";
}