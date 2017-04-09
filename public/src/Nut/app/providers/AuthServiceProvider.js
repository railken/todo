/**
 * Retrieve info about user
 */
var AuthServiceProvider = function()
{


	/**
	 * Name service provider
	 *
	 * @var {string}
	 */
	this.name = 'auth';


};



/**
 * Initialize the provider
 *
 * Execute and call the next in stack
 *
 * @param {this}
 * @param {callback} next
 *
 * @return void
 */
AuthServiceProvider.prototype.initialize = function(self, next)
{
	var um = new UserManager();
	
	if (um.storage.token.get()) {

        App.get('api').setToken(um.storage.token.get());

        var user = um.getProfile({
        	params: {},
        	success: function(user) {

        		App.set('user', user);

        		$('body').attr('user', 1);
				next();
        	},
        	error: function(response) {

        		um.storage.token.remove();
        		$('body').attr('user', 0);
				next();
        	},
        });
	} else {

        $('body').attr('user', 0);
		next();
	}

};