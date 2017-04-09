/**
 * Retrieve info about user
 */
var UserServiceProvider = function()
{


	/**
	 * Name service provider
	 *
	 * @var {string}
	 */
	this.name = 'user';


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
UserServiceProvider.prototype.initialize = function(self, next)
{
	
	next();

};