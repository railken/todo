$('body').on('submit', '.projects-add', function(e) {
	e.preventDefault();

	var pm = new ProjectManager();
	var name = $(this).find("[name='name']").val();
	var project = new Project({id: null, name: name, tasks: {
		undone: 0,
		done: 0,
		list: []
	}});

	App.get('user').projects.push(project);
	template.load('nav-projects');

	pm.create({
		params: {
			name: name,
		},
		success: function(project) {
			var index = App.get('user').projects.findByAttribute('name', project.name);
			App.get('user').projects[index] = project;
			template.load('nav-projects');
		},
		error: function(response) {
			App.get('flash').error(response.message);
		},
	})

});

$('body').on('submit', '.projects-delete', function(e) {
	e.preventDefault();
	$('.modal').modal('hide');

	var pm = new ProjectManager();

	var id = $(this).find("[name='id']").val();

	App.get('user').projects.removeByAttribute('id', id);

	template.load('nav-projects');

	pm.delete(
		id,
		{
			success: function(project) {

				template.load('nav-projects');

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
	template.load('nav-projects');

	pm.update(
		id,
		{
			params: {
				name: name
			},
			success: function(project) {
					
				var index = App.get('user').projects.findByAttribute('name', project.name);
				App.get('user').projects[index] = project;
				template.load('nav-projects');
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

$('body').on('click', '.task-done', function(e) {

	var manager = new TaskManager();

	var container = $(this).closest('.tasks-container');
	var id = $(this).attr('data-id');
	container.addClass('removed');

	manager.done(
		id,
		{
			success: function(project) {
				
				container.remove();
				reload();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			}
		}
	)

});