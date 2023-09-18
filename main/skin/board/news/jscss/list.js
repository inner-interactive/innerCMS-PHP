jQuery(function($){
	$('.favicon').each(function(index){
		$t = $(this);
		url = $t.parent('a.url').attr('href');
		$.ajax({
			url : skinUrl+"getFaviconAjax.php",
			type : "post",
			dataType : "json",
			data : { url : url },
			success : function(data){
				if(data.src != '')
					$('.favicon').eq(index).attr('src', data.src);
			}
		});
	});
});