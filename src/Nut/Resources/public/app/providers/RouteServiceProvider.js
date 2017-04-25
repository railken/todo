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

	var container = $('main');
	App.get('router')

				
		/*
		|--------------------------------------------------------------------------
		| Index
		|--------------------------------------------------------------------------
		|
		*/
		.on('/', function() {

			container.html(template.get('layout', {user: App.get('user')}));
			$('.content').html(template.get('home', {user: App.get('user')}));

			App.fireEvent('loaded');
		})

		/*
		|--------------------------------------------------------------------------
		| Project
		|--------------------------------------------------------------------------
		|
		*/
		.on('projects/:id', function (params) {

			var pm = new ProjectManager();

			console.log('aaaa');

			pm.get(params.id, {
				success: function(project) {

					var tm = new TaskManager();

					var search = {};
					search['project_id'] = project.id;

					// Add attribute active for current project

					App.get('user').projects.map(function(element) {element.active = false});
					k = App.get('user').projects.findByAttribute('id', project.id);
					App.get('user').projects[k].active = true;

					tm.list({
						params: {search: search},
						success: function(tasks) {
							container.html(template.get('layout', {user: App.get('user')}));
							
							// Refresh content
							$('.content').html(template.get('project', {project: project, tasks: tasks, user: App.get('user')}));

							App.fireEvent('loaded');
						},
						error: function(response) {

						}
					});
				},
				error: function(response) {

					var message = response && response.code == '404' ? 'Project not found' : response.message;
					
					return App.get('flash').error(message); 
				}
			});
		})

		/*
		|--------------------------------------------------------------------------
		| Sign In
		|--------------------------------------------------------------------------
		|
		*/
		.on('sign-in', function () {
			console.log('a');
			container.html(template.get('sign-in'));
			App.fireEvent('loaded');
		})
	  	.resolve();

		$('body').on('click', "[data-href]", function(e) {
			e.preventDefault();


			App.get('router').navigate($(this).attr('data-href'));
		});
	next();
};