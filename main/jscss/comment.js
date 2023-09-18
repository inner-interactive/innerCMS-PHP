jQuery(function($){
	$commentView = $('.commentView');
	
	function captcha_append($el){
	  $.ajax({
            type: 'POST',
            url: captcha_url+'/comment_captcha_ajax.php',
            cache: false,
            async: false,
            success: function(text) {
            	$el.append(text);
            }
        });
	}
	
	//답글
	$commentView.find('.reply').click(function(){
		$li = $(this).closest('li');
		$li.find('.action').val('reply');
		$li.find('.memo').text('');
		$li.find('.commentwriteinner').show();
		$('.commentwrite').hide();
		$('#captcha').remove();
		captcha_append($li.find('.captcha_layer'));
		return false;
	});
	
	//수정
	$commentView.find('.edit').click(function(){
		$li = $(this).closest('li');
		$li.find('.action').val('update');
		$text = $li.find('.memo').data('text');
		$li.find('.memo').text($text);
		$li.find('.commentwriteinner').show();
		$('.commentwrite').hide();
		$('#captcha').remove();
		captcha_append($li.find('.captcha_layer'));
		return false;
	});
	
	//삭제
	$commentView.find('.delHide').click(function(){
		$li = $(this).closest('li');
		$li.find('.action').val('delete');
		$li.find('.opt').val(0);
		if(confirm('코멘트를 삭제하시겠습니까?')){
			$(this).closest('form').submit();
		}
	});
	
	//완전삭제
	$commentView.find('.delReal').click(function(){
		$li = $(this).closest('li');
		$li.find('.action').val('delete');
		$li.find('.opt').val(2);
		if(confirm('코멘트를 완전삭제하시겠습니까?')){
			$(this).closest('form').submit();
		}
	});
	
	//복구
	$commentView.find('.recover').click(function(){
		$li = $(this).closest('li');
		$li.find('.action').val('delete');
		$li.find('.opt').val(1);
		if(confirm('코멘트를 복구하시겠습니까?')){
			$(this).closest('form').submit();
		}
	});
	
	//취소
	$commentView.find('.close').click(function(){
		$li = $(this).closest('li');
		$li.find('.commentwriteinner').hide();
		return false;
	});
	
	//확인
	$commentView.find('.apply').click(function(){
		$(this).closest('form').submit();
	});
	
});