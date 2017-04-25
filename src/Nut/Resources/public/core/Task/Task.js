var Task = function(attributes)
{

    this.fill(attributes);

};

Task.prototype = Object.create(Entity.prototype);
Task.prototype.constructor = Task;