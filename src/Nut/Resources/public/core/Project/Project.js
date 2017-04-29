var Project = function(attributes)
{

	this.fill(attributes);

};


Project.prototype = Object.create(Entity.prototype);
Project.prototype.constructor = Project;

Project.create = function(attributes)
{
	var project = new Project({id: null, name: name, tasks: {
		undone: 0,
		done: 0,
		list: []
	}});

	project.fill(attributes);

	return project;
}