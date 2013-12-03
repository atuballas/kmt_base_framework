$(document).ready(function(){
	$('#authenticate-button').bind('click',function(){
		var ajaxRequest = $.ajax({
			url: SITEURL + 'admin/login/authenticate/',
			data:{username:$('#username').val(), password:$('#password').val(), token:$('#token').val()},
			dataType: 'json',
			type: 'POST',
			beforeSend:function(){
				$('#authenticate-button').html('Authenticating...');
			}
		});
		ajaxRequest.done(function(response){
			if(response['status']=='success'){
				window.location.href=SITEURL+'admin/dashboard/';
			}else{
				$('#authenticate-button').html('Log in');
			}
		});
	});		
});


