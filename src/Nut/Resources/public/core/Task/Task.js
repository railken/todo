var Task = function(attributes)
{

    this.fill(attributes);
};

Task.prototype = Object.create(Entity.prototype);
Task.prototype.constructor = Task;

Task.create = function(attributes)
{

	var task = new Task();
    task.uid = uid();
	task.fill(attributes);

	return task;
};

Task.prototype.fill = function(attributes)
{
	Object.getPrototypeOf(Task.prototype).fill.call(this, attributes);


    this.priority_0 = this.priority == 0;
    this.priority_1 = this.priority == 1;
    this.priority_2 = this.priority == 2;
    this.priority_3 = this.priority == 3;

    return this;

};