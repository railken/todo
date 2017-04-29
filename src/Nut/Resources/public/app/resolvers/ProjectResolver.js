var ProjectResolver = function()
{	

	this.manager = new ProjectManager();
};

/**
 * Reload template
 *
 * @return void
 */
ProjectResolver.prototype.template = function()
{
	template.load('nav-projects');
}

/**
 * Create a new project
 *
 * @var {object} attributes
 *
 * @return void
 */
ProjectResolver.prototype.create = function(attributes)
{

	var self = this;
	var project = Project.create(attributes);
	var tmp_id = project.uid;
	App.get('user').projects.push(project);


	self.template();

	self.manager.create({
		params: attributes,
		success: function(project) {

			App.get('user').getProjectBy('uid', tmp_id).fill(project);
			self.template();
		},
		error: function(response) {
			App.get('flash').error(response.message);
		},
	})

};

/**
 * Remove a project
 *
 * @param {integer} id
 *
 * @return void
 */
ProjectResolver.prototype.remove = function(id)
{

	var self = this;

	App.get('user').removeProjectBy('id', id);
	
	self.template();

	self.manager.delete(
		id,
		{
			success: function(project) {
				self.template();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)

};

/**
 * Update a project
 *
 * @param {integer} id
 * @param {object} attributes
 *
 * @return void
 */
ProjectResolver.prototype.update = function(id, attributes)
{

	var self = this;

	App.get('user').getProjectById(id).fill(attributes);

	self.template();

	self.manager.update(
		id,
		{
			params: attributes,
			success: function(project) {

				App.get('user').getProjectById(project.id).fill(project);
				self.template();
			},
			error: function(response) {
				App.get('flash').error(response.message);
				self.template();
			},
		}
	)

}