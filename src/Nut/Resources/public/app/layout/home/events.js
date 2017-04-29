$('body').on('submit', '.projects-add', function(e) {
	e.preventDefault();
	var input_name = $(this).find("[name='name']");

	var resolver = new ProjectResolver();
	resolver.create({
		name: input_name.val()
	});

	input_name.val('');
});

$('body').on('submit', '.projects-delete', function(e) {
	e.preventDefault();
	$('.modal').modal('hide');
	var id = $(this).find("[name='id']").val();

	var resolver = new ProjectResolver();
	resolver.remove(id);
	
});


$('body').on('submit', '.projects-edit', function(e) {
	
	e.preventDefault();

	var id = $(this).find("[name='id']").val();
	var input_name = $(this).find("[name='name']");

	var resolver = new ProjectResolver();

	resolver.update(id, {
		name: input_name.val()
	});

	input_name.val('');

});

$('body').on('submit', '.tasks-add', function(e) {
	e.preventDefault();

	var resolver = new TaskResolver();

	resolver.create({
		title: $(this).find("[name='name']").val(),
		project_id: $(this).find("[name='project_id']").val(),
	});

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