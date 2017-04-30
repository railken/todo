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

	toggle.save();
	template.load('header');
	template.load('content');
	template.load('nav-projects');
	toggle.rollback();

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

	App.get('user').getProjectById(task.project_id).addTask(task);
	var tmp_id = task.uid;
	this.template();

	var self = this;

	this.manager.create({
		params: attributes,
		success: function(task) {

			App.get('user').getTaskBy('uid', tmp_id).fill(task);

			self.template();
		},
		error: function(response) {
			App.get('flash').error(response.message);
		},
	})

};

/**
 * Edit a task
 *
 * @param {integer} id
 * @param {object} attributes
 *
 * @return void
 */
TaskResolver.prototype.update = function(id, attributes)
{

	var self = this;

	App.get('user').getTaskById(id).fill(attributes);
	self.template();

	self.manager.update(
		id,
		{
			params: attributes,
			success: function(task) {
				App.get('user').getTaskById(task.id).fill(task);
				self.template();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)
};


/**
 * Set a task as "done"
 *
 * @param {integer} id
 *
 * @return void
 */
TaskResolver.prototype.done = function(id)
{

	var self = this;
	App.get('user').removeTaskById(id);
	self.template();

	self.manager.done(
		id,
		{
			success: function(task) {
				
				self.template();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			}
		}
	)
};

/**
 * Remove a task
 *
 * @param {integer} id
 *
 * @return void
 */
TaskResolver.prototype.remove = function(id)
{

	var self = this;
	App.get('user').removeTaskById(id);
	self.template();

	self.manager.remove(
		id,
		{
			success: function(task) {
				
				self.template();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			}
		}
	)
};