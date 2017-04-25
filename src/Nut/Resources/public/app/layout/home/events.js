$('body').on('submit', '.projects-add', function(e) {
	e.preventDefault();

	var pm = new ProjectManager();

	pm.create({
		params: {
			name: $(this).find("[name='name']").val(),
		},
		success: function(project) {
			App.get('user').projects.push(project);
			reload();
		},
		error: function(response) {
			App.get('flash').error(response.message);
		},
	})

});

$('body').on('submit', '.projects-delete', function(e) {
	e.preventDefault();

	var pm = new ProjectManager();

	var id = $(this).find("[name='id']").val();


	pm.delete(
		id,
		{
			success: function(project) {
				App.get('router').navigate('/');
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)

});


$('body').on('submit', '.projects-edit', function(e) {
	e.preventDefault();

	var pm = new ProjectManager();

	var id = $(this).find("[name='id']").val();
	var name = $(this).find("[name='name']").val();

	App.get('user').projects.getByAttribute('id', id).name = name;
	$(this).closest("[data-container]").find('.project-title').html(name);

	pm.update(
		id,
		{
			params: {
				name: name
			},
			success: function(project) {
				
				reload();
				// Request has already been made
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)

});

$('body').on('submit', '.tasks-add', function(e) {
	e.preventDefault();

	var tm = new TaskManager();

	tm.create({
		params: {
			title: $(this).find("[name='name']").val(),
			project_id: $(this).find("[name='project_id']").val(),
		},
		success: function() {
			reload();
		},
		error: function(response) {
			console.log(response);
			App.get('flash').error(response.message);
		},
	})

});

$('body').on('submit', '.tasks-edit', function(e) {
	e.preventDefault();

	var manager = new TaskManager();

	var id = $(this).find("[name='id']").val();
	var name = $(this).find("[name='name']").val();

	$(this).closest("[data-container]").find('.tasks-title').html(name);

	manager.update(
		id,
		{
			params: {
				title: name
			},
			success: function(project) {
				
				reload();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)

});
