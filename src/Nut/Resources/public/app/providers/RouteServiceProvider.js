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


RouteServiceProvider.prototype.getTemplateMain = function()
{

	/** Main layout **/
	var main = template
		.define('main')
		.source('layout')
		.vars({user: App.get('user') })
		.container(function() {
			return $('main'); 
		});

	/** List projects **/
	template
		.define('nav-projects')
		.source('nav-projects')
		.vars({user: App.get('user') })
		.container(function() {
			return $('.nav-projects');
		})
		.ready(function() {
			toggle.reload();
		})
		.parent(main);

	return main;

}


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

	var container = $('main');

	App.get('router')

				
		/*
		|--------------------------------------------------------------------------
		| Index
		|--------------------------------------------------------------------------
		|
		*/
		.on('/', function() {

			var main = self.getTemplateMain();
			template
				.define('home')
				.source('home')
				.vars({user: App.get('user')})
				.container(function() {
					return $('.content'); 
				})
				.parent(main);


			template.load('main');

			App.set('route', {name: 'home'});
			App.fireEvent('loaded');
		})

		/*
		|--------------------------------------------------------------------------
		| Project
		|--------------------------------------------------------------------------
		|
		*/
		.on('projects/:id', function (params) {

			var main = self.getTemplateMain();
			var project = App.get('user').getProjectById(params.id);

			if (!project) {
				App.get('flash').error('Project not found'); 
				App.get('router').navigate("/");
				return;
			}

			template
				.define('content')
				.source('project')
				.vars({project: project, tasks: project.tasks, user: App.get('user')})
				.container(function() {
					return $('.content');
				})
				.parent(main);


			template.load('main');
			App.set('route', {name: 'project', data: project});
			App.fireEvent('loaded');
		})

		/*
		|--------------------------------------------------------------------------
		| Sign In
		|--------------------------------------------------------------------------
		|
		*/
		.on('sign-in', function () {
			
			container.html(template.get('sign-in'));

			App.set('route', {name: 'sign-in'});
			App.fireEvent('loaded');
		});

		$('body').on('click', "[data-href]", function(e) {
			e.preventDefault();


			App.get('router').navigate($(this).attr('data-href'));
		});
	next();
};