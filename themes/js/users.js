$(document).ready(function(){
	var ajaxRequest = $.ajax({
		url: SITEURL + 'admin/users/fetchAllUsers/',
		data:{},
		dataType: 'json',
		type: 'POST',
		beforeSend:function(){
			$('div.users table tbody').html('').html('Fetching results. Please hang tight.');
		}
	});
	ajaxRequest.done(function(response){
		if(response['status']=='success'){
			$('div.users table tbody').html('').html(response['data']);
		}else{
			$('div.users table tbody').html('').html('Oops. We are unable to fetch results.');
		}
	});	
});


