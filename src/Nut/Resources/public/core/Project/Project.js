var Project = function(attributes)
{

	this.fill(attributes);

};

Project.prototype = Object.create(Entity.prototype);
Project.prototype.constructor = Project;