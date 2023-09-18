jQuery(function(){
	$('.st_search, .ca_search').click(function(){
		location.href = $(this).val();
	});
	
	
	$('.leftnav-title').click(function(){
		$(this).toggleClass('pluson');
		$(this).next('div').toggle();
	});
	
	$('#st_search').click(function(){
		$('#start_date').focus();
	});
	
	$('#ed_search').click(function(){
		$('#end_date').focus();
	});
	
	$('#start_date, #end_date').change(function(){
		$(this).closest('form').submit();
	});
	
	
	time_txt = $('#svtime').text();
	if(time_txt != ''){
		div = time_txt.split(' ');
		date_div = div[0].split('-');	
		time_div = div[1].split(':');
		year = date_div[0];
		month = parseInt(date_div[1]) - 1;
		day = date_div[2];
		hour = time_div[0];
		minute = time_div[1];
		second = time_div[2];
		
		time = new Date(year, month, day, hour, minute, second);
		
		
		function sv_clock(t) {
			
			one_second_after = t.getTime() + 1000;
			
		    var now = new Date(one_second_after);
		    var y = now.getFullYear();
		    var m = checkTime(now.getMonth() + 1);
		    var d = checkTime(now.getDate());
		    var h = checkTime(now.getHours());
		    var i = checkTime(now.getMinutes());
		    var s = checkTime(now.getSeconds());
		    new_t = y + "-" + m + "-" + d + " " +  h + ":" + i + ":" + s;
		    time = now;
		    $('#svtime').html(new_t);
		}

		function checkTime(i) {
			if (i < 10) {i = "0" + i}; // 숫자가 10보다 작을 경우 앞에 0을 붙여줌
			return i;
		}

		window.setInterval(function(){
			sv_clock(time);
		}, 1000)
	}
	
	

});