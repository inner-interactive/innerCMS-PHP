<?php

/*

		lib 폴더의 thumnail.php 를 include 해주고 file 이름과 가로, 세로를 지정하면 된다. 그러나 경로는 모두 절대 경로를 써주어야 한다.

		thumnail(원본파일절대경로이름, 썸네일파일이름만, 썸네일이저장될파일절대경로이름, 썸네일가로사이즈, 썸네일세로사이즈);

*/
		function makethumbnail($file, $data_path, $save_path, $width, $height, $isforce){

			$thumnailfilename = "";

			if (file_exists($save_path."thumbnail_".$file)) {
				$isfilenew =false;
			} else {
				$isfilenew =true;
			}
			if($isfilenew == true || ($isfilenew == false && $isforce == true)){
				//thumbnail($data_path."/".$file, "thumbnail_".$file, $save_path, $width, $height);
				thumbnail2($data_path."/".$file, $save_path."thumbnail_".$file, $width, $height, 0, 100);
				$thumnailfilename = "thumbnail_".$file;
			}

			return $thumnailfilename;	// 만들어진 썸네일 파일 이름을 반환한다.
			
		}



		function makethumbnail2($indexChar, $file, $data_path, $save_path, $width, $height, $isforce){

			$thumnailfilename = "";

			if (file_exists($save_path."thumbnail_".$indexChar.$file)) {
				$isfilenew =false;
			} else {
				$isfilenew =true;
			}

			if($isfilenew == true || ($isfilenew == false && $isforce == true)){
				//thumbnail($data_path."/".$file, "thumbnail_".$file, $save_path, $width, $height);
				thumbnail2($data_path."/".$file, $save_path."thumbnail_".$indexChar.$file, $width, $height, 1,100);
			}

			return $thumnailfilename;	// 만들어진 썸네일 파일 이름을 반환한다.
			
		}


		
		function thumbnail($file, $save_filename, $save_path, $max_width, $max_height)
		{

			   $img_info = getImageSize($file);
			   if($img_info[2] == 1)
			   {
					  $src_img = ImageCreateFromGif($file);
					  }elseif($img_info[2] == 2){
					  $src_img = ImageCreateFromJPEG($file);
					  }elseif($img_info[2] == 3){
					  $src_img = ImageCreateFromPNG($file);
					  }else{
					  return 0;
			   }
			   $img_width = $img_info[0];
			   $img_height = $img_info[1];

			   if($img_width > $max_width || $img_height > $max_height)
			   {
					  if($img_width == $img_height)
					  {
							 $dst_width = $max_width;
							 $dst_height = $max_height;
					  }elseif($img_width > $img_height){
							 $dst_width = $max_width;
							 $dst_height = ceil(($max_width / $img_width) * $img_height);
					  }else{
							 $dst_height = $max_height;
							 $dst_width = ceil(($max_height / $img_height) * $img_width);
					  }
			   }else{
					  $dst_width = $img_width;
					  $dst_height = $img_height;
			   }
			   if($dst_width < $max_width) $srcx = ceil(($max_width - $dst_width)/2); else $srcx = 0;
			   if($dst_height < $max_height) $srcy = ceil(($max_height - $dst_height)/2); else $srcy = 0;

			   if($img_info[2] == 1) 
			   {
					  $dst_img = imagecreate($max_width, $max_height);
			   }else{
					  $dst_img = imagecreatetruecolor($max_width, $max_height);
			   }

			   $bgc = ImageColorAllocate($dst_img, 255, 255, 255);
			   ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc); 
			   ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

			   if($img_info[2] == 1) 
			   {
					  ImageInterlace($dst_img);
					  ImageGif($dst_img, $save_path."/".$save_filename);
			   }elseif($img_info[2] == 2){
					  ImageInterlace($dst_img);
					  ImageJPEG($dst_img, $save_path."/".$save_filename);
			   }elseif($img_info[2] == 3){
					  ImagePNG($dst_img, $save_path."/".$save_filename);
			   }
			   ImageDestroy($dst_img);
			   ImageDestroy($src_img);
		}



		
		function ImgSizeSet($ImgName,$getWSize="",$getHSize="",$oriWSize="",$oriHSize=""){

			if($oriWSize != "" && $oriHSize != ""){
				$ImgSize[0]	= $oriWSize;
				$ImgSize[1]	= $oriHSize;
			}else{
				$ImgSize	= @getimagesize($ImgName);
			}

			if($getWSize&&$getHSize){
				$PreWidth	= $getWSize;
				$PreHeight	= $getHSize;
			}
			else {
				$PreWidth	=$ImgSize[0];
				$PreHeight	=$ImgSize[1];
			}

			if ($ImgSize[0] >= $PreWidth && $ImgSize[1] >= $PreHeight)
			{
				$height = $PreWidth * $ImgSize[1] / $ImgSize[0];
				$width = $PreHeight * $ImgSize[0] / $ImgSize[1];

				if($width >= $PreWidth && $height <= $PreHeight){
					$width = $PreWidth;
					$height = $width * $ImgSize[1] / $ImgSize[0];
				}
				if($width <= $PreWidth && $height >= $PreHeight){
					$height = $PreHeight;
					$width = $height * $ImgSize[0] / $ImgSize[1];
				}
			}else if ($ImgSize[0] >= $PreWidth || $ImgSize[1] >= $PreHeight){
				if($ImgSize[0] >= $PreWidth){
					$width = $PreWidth;
					$height = $width * $ImgSize[1] / $ImgSize[0];
				}
				if($ImgSize[1] >= $PreHeight){
					$height = $PreHeight;
					$width = $height * $ImgSize[0] / $ImgSize[1];
				}
			}else{
				$width = $ImgSize[0];
				$height = $ImgSize[1];
			}

			if(!$width || !$height){
				$width = $PreWidth;
				$height = $PreHeight;
			}

			$ReSizeImg = array($width,$height);

			return $ReSizeImg;
		}



		### 썸네일 함수
		function thumbnail2($src,$folder,$sizeX=150,$sizeY=150,$fix=0,$quality=100)
		{
			$size	= getimagesize($src);

			switch ($size[2]){
				case 1:	$image	= @ImageCreatefromGif($src); break;
				case 2:	$image	= ImageCreatefromJpeg($src); break;
				case 3:	$image	= ImageCreatefromPng($src);  break;
			}
			if ($fix){
				$gap = abs($size[0]-$size[1]);
				switch ($fix){
					case 1:		# 설정된 크기에 따라 비율을 조정
						$reSize		= ImgSizeSet($src,$sizeX,$sizeY,$size[0],$size[1]);
						$g_width	= 0;
						$g_height	= 0;
						$newSizeX	= $reSize[0];
						$newSizeY	= $reSize[1];
						break;
					case 2:		# 사용되지 않음
						if ($size[0]>$size[1]) $g_width  = $gap / 2;
						else $g_height = $gap / 2;
						$newSizeX	= $sizeX;
						$newSizeY	= $sizeX;
						if ($size[0]>$size[1]) $size[0] = $size[1];
						else $size[1] = $size[0];
						break;
					case 3:		# 사용되지 않음
						if ($size[0]>$size[1]) $g_width  = $gap;
						else $g_height = $gap;
						$newSizeX	= $sizeX;
						$newSizeY	= $sizeX;
						if ($size[0]>$size[1]) $size[0] = $size[1];
						else $size[1] = $size[0];
						break;
					case 4:
						$newSizeX	= $sizeX;
						$newSizeY	= $sizeY;
						break;
				}

				$dst	= ImageCreateTruecolor($newSizeX,$newSizeY);
				Imagecopyresampled($dst,$image,0,0,$g_width,$g_height,$newSizeX,$newSizeY,$size[0],$size[1]);
			} else {
				$width	= $sizeX;
				$height = $size[1] / $size[0] * $sizeX;
				$dst	= ImageCreateTruecolor($width,$height);
				
				Imagecopyresampled($dst,$image,0,0,0,0,$width,$height,$size[0],$size[1]);
			}
			ImageJpeg($dst,$folder,$quality);
			ImageDestroy($dst);
			@chmod($folder,0707); // 업로드된 파일 권한 변경
		}


?>