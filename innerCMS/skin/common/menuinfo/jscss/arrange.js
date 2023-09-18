jQuery(function($){

	$('#menu_arrange').find('ul').addClass('droptrue');

	$( "ul.droptrue").sortable({
		connectWith: "ul"
	});

	$( "ul.dropfalse").sortable({
		connectWith: "ul",
		dropOnEmpty: false
	});

	$('.arrange_apply').click(function(){
    	
		arrangeText =  '';
		
		$li = $('#menu_arrange .ui-sortable-handle');
		$li.each(function(){
			
			
			no = $(this).data('no');
			
			parentId = $(this).parent().parent('li').data('no');
			if(parentId == undefined){
				parentId = 0;
			} 
			
			rank = $(this).parents('li.ui-sortable-handle').length + 1;
			
			orderNum = $(this).index() + 1;
			
			arrangeText += no + '|' + parentId + '|' + orderNum + '|' + rank + ';|;';
			
			$('#arrangeText').val(arrangeText);
		});
		
	});

});