<?php

	function downloadFile( $fullPath, $newfileName ){
	  // Must be fresh start
	  if( headers_sent() )
		die('Headers Sent');

	  // Required for some browsers
// 	  if(ini_get('zlib.output_compression'))
// 		ini_set('zlib.output_compression', 'Off');

	  // File Exists?
	  
	  if( file_exists($fullPath) ){
	   
		// Parse Info / Get Extension
		$fsize = filesize($fullPath);
		$path_parts = pathinfo($fullPath);
		
		
		$download_rate = 5000.0;
		$ext = strtolower($path_parts["extension"]);
		
		// Determine Content Type
		switch ($ext) {
		  //This will set the Content-Type to the appropriate setting for the file 
		  case "pdf": $ctype="application/pdf"; break;
		  case "exe": $ctype="application/octet-stream"; break;
		  case "zip": $ctype="application/zip"; break;
		  case "doc": $ctype="application/msword"; break;
		  case "xls": $ctype="application/vnd.ms-excel"; break;
		  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		  case "hwp": $ctype="application/unknown"; break;
		  case "gif": $ctype="image/gif"; break;
		  case "png": $ctype="image/png"; break;
		  case "jpeg":
		  case "jpg": $ctype="image/jpg"; break;
		  case "mp3": $ctype="audio/mpeg"; break; 
		  case "wav": $ctype="audio/x-wav"; break; 
		  case "mpeg": 
		  case "mpg": 
		  case "mpe": $ctype="video/mpeg"; break; 
		  case "mov": $ctype="video/quicktime"; break; 
		  case "avi": $ctype="video/x-msvideo"; break; 
  		  //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files) 
		  case "php": 
		  case "htm": 
		  case "html": die("<b>Cannot be used for ". $ext ." files!</b>"); break; 
		  //case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break; 
		  default: $ctype="application/force-download";
		
		}

	    $newfileName = @iconv("UTF-8","EUC-KR//TRANSLIT", $newfileName);
		
	    
		if(file_exists($fullPath) && is_file($fullPath)) {
		    
		    
		    if (preg_match("/MSIE/i", $_SERVER['HTTP_USER_AGENT'])) { 
		        header("Pragma: no-cache");
		        header("Expires: 0"); 
		        //header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		        header("Cache-Control: no-cache, no-stroe");
		        header("Content-Transfer-Encoding: binary");
		        header("Content-Disposition: attachment; filename=$newfileName"); // 다운로드되는 파일명 (실제 파일명과 별개로 지정 가능)
		        header("Content-Length: ".filesize($fullPath));
		        header("Content-type: application/octet-stream");
		        
		    }else{
    		    header("Pragma: no-cache");
    		    header("Expires: 0");
    		    //header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    		    header("Cache-Control: no-cache, no-stroe");
    		    header("Content-Description: File Transfer");
    		    header("Content-Disposition: attachment; filename=\"".$newfileName."\"");
    		    header("Content-Transfer-Encoding: binary");
    		    header("Content-Length: ".filesize($fullPath));
    		    header("Content-Type: $ctype");
		    }
		    // flush content
		    flush();
		    // open file stream
		    
	        $file = fopen($fullPath, "rb");
	        fpassthru($file);

		    
		    // close file stream
		    fclose($file);
		}
        
		
	  } else
		die('File Not Found');

	}


?>