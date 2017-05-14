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


$('body').on('click', ".task-edit-priority", function(e) {
	var form = $(this).closest('form');
	var priority = $(this).attr('data-priority');
	form.find("[name='priority']").val(priority);
	form.find(".task-edit-priority").removeClass('selected');
	form.find(".task-edit-priority[data-priority='"+priority+"']").addClass('selected');
	form.find(".task-edit-priority-container").attr('data-priority', priority);
	form.find("[data-popover]").popover('hide')
});


$('body').on('submit', "[name='task-edit']", function(e) {

	console.log(e);
	e.preventDefault();
	var container = $(this);

	var resolver = new TaskResolver();

	var attributes = {};

	container.find("input, select, textarea").each(function(){
		attributes[$(this).attr('name')] = $(this).val();
	});

	resolver.update(attributes.id, attributes);
});


$('body').on('submit', "[name='task-delete']", function(e) {
	e.preventDefault();

	$('.modal').modal('hide');
	var resolver = new TaskResolver();

	resolver.remove($(this).find("[name='id']").val());
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
