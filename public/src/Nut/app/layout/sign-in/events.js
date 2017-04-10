$('body').on('click', '[auth]', function(e) {


	auth.popup(App.get('api').url+'/oauth/'+$(this).attr('auth')+"/authorize", {
		success: function(response) {

			App.get('router').redirect('/');
			
		},
		error: function(response) {
			alert('Something bad has appened');
		}
	});

});