var User = function(attributes)
{

	this.fill(attributes);

};

User.prototype = Object.create(Entity.prototype);
User.prototype.constructor = User;