var User = function(attributes)
{

	// Convert Array into Collection;
	attributes.projects = attributes.projects.map(function(project) {
		return new Project(project);
	});

	this.fill(attributes);

};

User.prototype = Object.create(Entity.prototype);
User.prototype.constructor = User;


/**
 * Find a project by attribute and value
 *
 * @param {string} name
 * @param {mixed} value
 *
 * @return {Project}
 */
User.prototype.getProjectBy = function(name, value)
{
	return this.projects.getByAttribute(name, value);
}

/**
 * Get project by id
 *
 * @param {integer} id
 *
 * @return {Project}
 */
User.prototype.getProjectById = function(id)
{
	return this.getProjectBy('id', id);
}

/**
 * Remove a project by attribute and value
 *
 * @param {string} name
 * @param {mixed} value
 *
 * @return void
 */
User.prototype.removeProjectBy = function(name, value)
{
	return this.projects.removeByAttribute(name, value);
}

/**
 * Find a task by attribute and value
 *
 * @param {string} name
 * @param {mixed} value
 *
 * @return {Task}
 */
User.prototype.getTaskBy = function(name, value)
{
	var task;

	for (var i in this.projects) {

		console.log(this.projects[i]);
		task = this.projects[i].getTaskBy(name, value);

		if (task)
			return task;
	}


	return null;

}

/**
 * Find a task by id
 *
 * @param {integer} id
 *
 * @return {Task}
 */
User.prototype.getTaskById = function(id)
{
	return this.getTaskBy('id', id);
}