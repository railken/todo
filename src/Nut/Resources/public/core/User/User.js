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