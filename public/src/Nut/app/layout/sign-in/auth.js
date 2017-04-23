var auth = {};


auth.popup = function(url)
{	

	w = 400;
	h = 550;
	
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;

    var w = window.open(url, 'sign-in', 'menubar=1,resizable=1,scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    if (window.focus)
        w.focus();
    

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

						App.set('user', user);
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