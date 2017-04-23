var ProjectManager = function(){



};

/**
 * Create a new project
 *
 * @param {object} vars
 *
 * @return void
 */
ProjectManager.prototype.create = function(vars)
{

	App.get('api').basicCall('POST', '/user/projects', {
		params: vars.params,
		success: function(response) {
			vars.success(new Project(response.data.resources));
		},
		error: vars.error,
	});

};


/**
 * Retrieve a project given id
 *
 * @param {integer} id
 * @param {object} vars
 *
 * @return void
 */
ProjectManager.prototype.get = function(id, vars)
{
    App.get('api').basicCall('GET', '/user/projects/'+id , {
        success: function(response) {
            vars.success(new Project(response.data.resources));
        },
        error: vars.error
    });
};



/**
 * Delete project given id
 *
 * @param {integer} id
 * @param {object} vars
 *
 * @return void
 */
ProjectManager.prototype.delete = function(id, vars)
{
    App.get('api').basicCall('DELETE', '/user/projects/'+id , {
        success: vars.success,
        error: vars.error
    });
};