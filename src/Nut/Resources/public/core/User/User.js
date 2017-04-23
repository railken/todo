var User = function(attributes)
{

	// Convert Array into Collection;
	attributes.projects = collect(attributes.projects);

	console.log(attributes.projects);
	this.fill(attributes);

};

User.prototype = Object.create(Entity.prototype);
User.prototype.constructor = User;