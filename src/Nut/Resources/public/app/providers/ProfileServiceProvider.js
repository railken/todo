/**
 * Retrieve info about user
 */
var ProfileServiceProvider = function()
{


	/**
	 * Name service provider
	 *
	 * @var {string}
	 */
	this.name = 'profile';


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
ProfileServiceProvider.prototype.initialize = function(self, next)
{
	
	ProfileResolver.reload(App.get('user'));

	next();

};