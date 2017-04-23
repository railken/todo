var toggle = {};

toggle.change = function(element)
{

	element.find("[data-panel]").hide();

	var value = element.attr('data-status');
	element.find("[data-panel='"+value+"']").show();
}


toggle.reload = function()
{

	console.log('a');
	$.map($('.toggle'), function(el) {
		toggle.change($(el));
	});
}

$('body').on('click', "[data-open]", function() {

	var container = $(this).closest('.toggle');
	container.attr('data-status', $(this).attr('data-open'));
	toggle.change(container);
});
