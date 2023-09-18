jQuery(function($){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    
    $('.conts > div').hide();
    $('.conts > div').eq(0).fadeIn();
    
    $('.viewtab li a').click(function(){
    	index = $(this).parent('li').index();
    	$('.viewtab li ').removeClass('active');
    	$(this).parent('li').addClass('active');
    	
    	$('.conts > div').hide();
    	$('.conts > div').eq(index).fadeIn();
    	
    	return false;
    });
});

