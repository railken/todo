var ProjectResolver = function()
{	

	this.manager = new ProjectManager();
};


ProjectResolver.prototype.create = function(attributes)
{


	var project = Project.create(attributes);
	App.get('user').projects.push(project);

	template.load('nav-projects');

	this.manager.create({
		params: attributes,
		success: function(project) {

			// By name? Uhm...
			var index = App.get('user').projects.findByAttribute('name', project.name);
			App.get('user').projects[index].fill(project);
			template.load('nav-projects');
		},
		error: function(response) {
			App.get('flash').error(response.message);
		},
	})

};

ProjectResolver.prototype.remove = function(id)
{

	App.get('user').projects.removeByAttribute('id', id);
	template.load('nav-projects');

	this.manager.delete(
		id,
		{
			success: function(project) {
				template.load('nav-projects');
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)

};

ProjectResolver.prototype.update = function(id, attributes)
{

	// Retrieve and update local project
	var project = App.get('user').projects.getByAttribute('id', id);
	project.fill(attributes);

	// Reload template
	template.load('nav-projects');

	// Send API request
	this.manager.update(
		id,
		{
			params: attributes,
			success: function(project) {

				var index = App.get('user').projects.findByAttribute('id', project.id);
				App.get('user').projects[index].fill(project);
				template.load('nav-projects');
			},
			error: function(response) {
				App.get('flash').error(response.message);
				template.load('nav-projects');
			},
		}
	)

}