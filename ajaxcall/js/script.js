$('document').ready(function()
{ 

$("#login-form").submit(function(e) {
	e.preventDefault();
	
	$.ajax({
type: "POST",
url: "ajaxcall/login_process.php",
data : {username: $("#username").val(),password:$("#password").val()},
beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="mdi mdi-alarm-multiple"></span> &nbsp; sending ...');
			},


success:function(response) {
	if(response!=1) 
	{
	
				$("#error").fadeIn(10, function(){						
				$("#error").html('<div class="alert alert-danger"> <span class="mdi mdi-information"></span> &nbsp; '+response+' !</div>');
	$("#btn-login").html('<span class="mdi mdi-login-variant"></span> &nbsp; Login');
	
	setTimeout(function(){ $("#error").fadeOut(); }, 2000);
				});
									

	}
	else
	{
	$("#btn-login").html('<img src="assets/img/spinner-white.svg" />');

	setTimeout(' window.location.href = "home.php"; ',1);
	}
}
});
	
});
});

    