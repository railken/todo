/**
 * Retrieve info about user
 */
var RouteServiceProvider = function()
{


	/**
	 * Name service provider
	 *
	 * @var {string}
	 */
	this.name = 'route';


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
RouteServiceProvider.prototype.initialize = function(self, next)
{
	var root = null;
	var useHash = true;
	var hash = '#!';
	App.set('router', new Navigo(root, useHash, hash));

	App.get('router')
		.on('/', function() {
			$('body').html(template.get('home', {user: App.get('user')}));
			App.fireEvent('loaded');
		})
		.on('/sign-in', function () {
			$('body').html(template.get('sign-in'));
			App.fireEvent('loaded');
		})
	  	.resolve();

	next();
};