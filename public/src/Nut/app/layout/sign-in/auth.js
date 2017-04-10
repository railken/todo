var auth = {};

auth.popup = function(url)
{
	
	w = window.open(url, 'sign-in','menubar=1,resizable=1,width=450,height=850');

	auth.clock(w);
	return auth;
}


auth.clock = function(w)
{	

	var url = null;

	try {
		url = w.location.href;
	} catch (e) {

	}

	if (url) {
		var parser = document.createElement('a');
		parser.href = url;

		if (parser.origin == config('url')) {

			var html = w.innerHTML;

			try {
				response = JSON.parse(html);

				if (response.status == 'error') {

					console.log('An error has occurred');
					w.close();
					return;
				}
			} catch (e) {

			}

			if (parser.pathname == "/api/v1/oauth/authenticated") {

				var token = parser.search.replace("?token=","");
				console.log('Authorized', token);

				um = new UserManager();
				um.authenticate(token, {
					params: {},
					success: function(user) {

						App.get('router').navigate("/");
						w.close();
					},
					error: function(response) {
						alert('An error has occurred');
					}
				});

				return;
			}

		}
	}

	setTimeout(function() {
		auth.clock(w);
	}, 1000);
}