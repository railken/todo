var Project = function(attributes)
{

	if (attributes.tasks.list) {
		attributes.tasks.list = attributes.tasks.list.map(function(task) {
			return new Task(task);
		});
	}

	this.fill(attributes);

};


Project.prototype = Object.create(Entity.prototype);
Project.prototype.constructor = Project;

/**
 * Create a new instance of project
 *
 * @param {object} attributes
 *
 * @return {Project}
 */
Project.create = function(attributes)
{
	var project = new Project({id: null, name: name, tasks: {
		undone: 0,
		done: 0,
		list: []
	}});

	project.uid = uid();
	project.fill(attributes);

	return project;
}

/**
 * Find a task by attribute and value
 *
 * @param {string} name
 * @param {mixed} value
 *
 * @return {Task}
 */
Project.prototype.getTaskBy = function(name, value)
{
	return this.tasks.list.getByAttribute(name, value);
}

/**
 * Find a task by id
 *
 * @param {integer} id
 *
 * @return {Task}
 */
Project.prototype.getTaskById = function(id)
{
	return this.getTaskBy('id', id);
}

/**
 * Remove a task by attribute and value
 *
 * @param {string} name
 * @param {mixed} value
 *
 * @return {Task}
 */
Project.prototype.removeTaskBy = function(name, value)
{
	return this.tasks.list.removeByAttribute(name, value);
}


/**
 * Add a task
 *
 * @param {Task}
 *
 * @return void
 */
Project.prototype.addTask = function(task)
{
	this.tasks.list.push(task);
};

