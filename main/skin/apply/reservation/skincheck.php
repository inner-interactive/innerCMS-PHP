<?php 
$_prejs_skin = $_js_skin = $_css_skin = array();

array_push($_css_skin, SKIN_URL."jscss/style.css");
if($mode == "list"){
    array_push($_js_skin, SKIN_URL."jscss/list.js");    
}else if($mode == 'view'){
    array_push($_js_skin, "../common/js/swiper.js");    
//     array_push($_css_skin, SKIN_URL."jscss/jquery.fancybox-1.3.4.css");    
//     array_push($_js_skin, SKIN_URL."jscss/jquery.mousewheel-3.0.4.pack.js");    
//     array_push($_js_skin, SKIN_URL."jscss/jquery.fancybox-1.3.4.pack.js");    
//     array_push($_js_skin, SKIN_URL."jscss/jquery.cycle.all.js");    
    array_push($_js_skin, SKIN_URL."jscss/view.js");    
}else if($mode == 'calendar'){
    array_push($_js_skin, SKIN_URL."jscss/calendar.js");    
    
}else if($mode == 'write'){
    array_push($_js_skin, "../common/js/common.js");    
    array_push($_js_skin, SKIN_URL."jscss/write.js");    
}else if($mode == 'myreservation'){
    array_push($_js_skin, "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js");    
    array_push($_css_skin, "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css");    
}



$system['jscss']['prejs_skin'] = $_prejs_skin;
$system['jscss']['js_skin'] = $_js_skin;
$system['jscss']['css_skin'] = $_css_skin;