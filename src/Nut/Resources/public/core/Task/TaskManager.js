var TaskManager = function(){



};


/**
 * Retrieve a group of tasks
 *
 * @param {object} vars
 *
 * @return void
 */
TaskManager.prototype.list = function(vars)
{   


    if (!vars.show)
        vars.show = 100;

    if (!vars.page)
        vars.page = 1;


    App.get('api').basicCall('GET', '/user/tasks', {
        params: vars.params,
        success: function(response) {
            vars.success(response.data);
        },
        error: vars.error,
    });

};


/**
 * Create a new Task
 *
 * @param {object} vars
 *
 * @return void
 */
TaskManager.prototype.create = function(vars)
{

	App.get('api').basicCall('POST', '/user/tasks', {
		params: vars.params,
		success: function(response) {
			vars.success(new Task(response.data.resources));
		},
		error: vars.error,
	});

};

/**
 * Update a task
 *
 * @param {integer} id
 * @param {object} vars
 *
 * @return void
 */
TaskManager.prototype.update = function(id, vars)
{

    App.get('api').basicCall('PUT', '/user/tasks/'+id , {
        params: vars.params,
        success: function(response) {
            vars.success(new Task(response.data.resources));
        },
        error: vars.error,
    });

};



/**
 * Retrieve a Task given id
 *
 * @param {integer} id
 * @param {object} vars
 *
 * @return void
 */
TaskManager.prototype.get = function(id, vars)
{
    App.get('api').basicCall('GET', '/user/tasks/'+id , {
        success: function(response) {
            vars.success(new Task(response.data.resources));
        },
        error: vars.error
    });
};



/**
 * Delete Task given id
 *
 * @param {integer} id
 * @param {object} vars
 *
 * @return void
 */
TaskManager.prototype.delete = function(id, vars)
{
    App.get('api').basicCall('DELETE', '/user/tasks/'+id , {
        success: vars.success,
        error: vars.error
    });
};