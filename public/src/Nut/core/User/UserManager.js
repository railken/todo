var UserManager = function(){


	/**
	 * Current order
	 *
	 * @var {User}
	 */
	this.user = null;

	this.storage = {};

	this.storage.token = new CookieStorage('token');

};

/**
 * Make a login request
 *
 * @param {object} vars
 *
 * @return void
 */
UserManager.prototype.login = function(vars)
{

	App.get('api').call('POST', '/oauth/access_token', vars.params, function(response) {

		if (response.error != undefined) {
			vars.error(response);
		}

		if (response.access_token != undefined) {
			vars.success(response);
		}

	});

};

/**
 * Get profile
 *
 * @param {object} vars
 *
 * @return void
 */
UserManager.prototype.getProfile = function(vars)
{

	App.get('api').basicCall('GET', '/user', {
		params: vars.params,
		success: function(response) {
			vars.success(new User(response.data.resource));
		},
		error: vars.error,
	});

};

UserManager.prototype.authenticate = function(token, vars)
{	
	App.get('api').setToken(token);
	this.storage.token.set(token);
	return this.getProfile(vars);
}