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
