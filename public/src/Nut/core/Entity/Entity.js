var Entity = function(attributes)
{	
	this.fill(attributes);
};

Entity.prototype.fill = function(attributes)
{

	var self = this;
	
	for (key in attributes) {
		self[key] = attributes[key];
	}

};