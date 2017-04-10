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
			console.log("I'm home");
			$('body').html(template.get('home'));
		})
		.on('/sign-in', function () {
			$('body').html(template.get('sign-in'));
		})
	  	.resolve();

	next();
};