// See password ----
var pwd = document.getElementById("toggle-password");

if (pwd) {
	pwd.addEventListener('click', function() {
		var x = document.getElementById("usr_pass");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	});
}

// Ready page ----
$(document).ready(function() {
	$( "#form_login" ).on( "submit", function( event ) {
		event.preventDefault();
		var mail = $('#usr_mail').val(),
			pass = $('#usr_pass').val(),
			btn = $('#btn_submit');
		if(mail && pass) {
			btn.html('Loading...').prop('disabled', true);
			$.ajax({
				type: 'POST',
				url: 'PHP/login.php',
				data: { pass:pass,mail:mail },
				success:function(datos){
					btn.html('Log In').prop('disabled', false);
					if (datos.Status === 'Ok') {
						location.href = "index.php";
					}else {
						if (datos.Message) {
							swal({ title: 'Error', text: datos.Message, type: 'error', padding: '2em'});
						}else {
							swal({ title: 'One moment...', text: "Your session got expired, please login again", type: 'alert', padding: '2em'}).then((function(t){location.reload();}));
						}
					}
				},
				error:function (xhr, ajaxOptions, thrownError) {
					btn.html('Log In').prop('disabled', false);
					swal({ title: 'Ups...', text: "We are experiencing some issues", type: 'error', padding: '2em'});
					console.log('code: '+xhr.status+' message: '+thrownError);
				}
			});
		} else {
			swal({ title: 'Wait', text: "You have to fill all the information", type: 'error', padding: '2em'});
		}
	});

	$( "#form_register" ).on( "submit", function( event ) {
		event.preventDefault();
		var name = $('#usr_name').val(),
			mail = $('#usr_mail').val(),
			pass = $('#usr_pass').val(),
			btn = $('#btn_submit');
		if(name && mail && pass) {
			btn.html('Loading...').prop('disabled', true);
			$.ajax({
				type: 'POST',
				url: 'PHP/register.php',
				data: { name:name,pass:pass,mail:mail },
				success:function(datos){
					btn.html('Get Started!').prop('disabled', false);
					if (datos.Status === 'Ok') {
						swal({ title: 'Good!', text: datos.Message, type: 'success', padding: '2em'}).then(function(){location.href = "login.php";});
					}else {
						if (datos.Message) {
							swal({ title: 'Error', text: datos.Message, type: 'error', padding: '2em'});
						}else {
							swal({ title: 'One moment...', text: "Your session got expired, please login again", type: 'error', padding: '2em'}).then((function(t){location.reload();}));
						}
					}
				},
				error:function (xhr, ajaxOptions, thrownError) {
					btn.html('Get Started!').prop('disabled', false);
					swal({ title: 'Ups...', text: "We are experiencing some issues", type: 'error', padding: '2em'});
					console.log('code: '+xhr.status+' message: '+thrownError);
				}
			});
		} else {
			swal({ title: 'Wait', text: "You have to fill all the information", type: 'error', padding: '2em'});
		}
	});
});