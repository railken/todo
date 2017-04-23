$('body').on('submit', '.projects_add', function(e) {
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