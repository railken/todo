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