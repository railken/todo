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
				App.get('user').projects.removeByAttribute('id', id);
				reload();
			},
			error: function(response) {
				App.get('flash').error(response.message);
			},
		}
	)

});