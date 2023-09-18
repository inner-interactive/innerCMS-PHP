jQuery(function($){
	
	$('.del').click(function(){
		if(!confirm('삭제한 데이터는 복구할 수 없습니다.\n삭제하시겠습니까?')) return false;
	});
	
	$('.del_file').click(function(){
		if(!confirm('삭제한 파일은 복구할 수 없습니다.\n파일을 삭제하시겠습니까?')) return false;
	});
	
	
	
	if ($.browser.msie) {
		// ie 일때 input[type=file] init.
	} else {
		// other browser 일때 input[type=file] init.
		$("input[type='file']").val("");
	}
	$("input[type='file']").change(function(){

		var fileValue = $(this).val().split("\\");
		var fileName = fileValue[fileValue.length-1]; // 파일명

		if($(this).val()!=""){
			$(this).parent().find(".upload-name").val(fileName);
		}else{
			$(this).parent().find(".upload-name").val("");
		}

	});
});