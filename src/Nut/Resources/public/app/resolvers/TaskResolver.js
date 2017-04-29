var TaskResolver = function()
{	

	this.manager = new TaskManager();
};


/**
 * Reload the template
 *
 * @return void
 */
TaskResolver.prototype.template = function()
{

	template.load('content');
	template.load('nav-projects');
};

/**
 * Create a new task
 *
 * @param {object} attributes
 *
 * @return void
 */
TaskResolver.prototype.create = function(attributes)
{

	var task = Task.create(attributes);

	App.get('user').getProjectById(task.project_id).tasks.list.push(task);
	
	this.template();

	var self = this;

	this.manager.create({
		params: attributes,
		success: function(task) {

			App.get('user').getTaskBy('uid', task.uid).fill(task);

			self.template();
		},
		error: function(response) {
			App.get('flash').error(response.message);
		},
	})

};