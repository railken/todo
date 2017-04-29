var Task = function(attributes)
{

    this.fill(attributes);

};

Task.prototype = Object.create(Entity.prototype);
Task.prototype.constructor = Task;

Task.create = function(attributes)
{

	var task = new Task();
	task.fill(attributes);

	return task;
}