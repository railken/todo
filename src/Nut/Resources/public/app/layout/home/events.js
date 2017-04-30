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

	var resolver = new TaskResolver();

	resolver.update($(this).find("[name='id']").val(), {
		title: $(this).find("[name='name']").val()
	});

});

$('body').on('click', '.task-done', function(e) {


	var container = $(this).closest('.tasks-container');
	
	container.addClass('removed');
	var id = $(this).attr('data-id');

	// Create an "transition"
	setTimeout(function() {

		var resolver = new TaskResolver();

		resolver.done(id);
	}, 200);


});