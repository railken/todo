var toggle = {};

toggle.change = function(element)
{

	var container = element.attr('data-container');

	if (container) {
		$.map($(".toggle[data-container='"+container+"']"), function(el) {
			$(el).find("[data-panel]").hide();
			$(el).find("[data-panel='1']").show();
		});
	}

	element.find("[data-panel]").hide();

	var value = element.attr('data-status');
	element.find("[data-panel='"+value+"']").show();

}


toggle.reload = function()
{

	$.map($('.toggle'), function(el) {
		toggle.change($(el));
	});
}

$('body').on('click', "[data-open]", function() {

	var container = $(this).closest('.toggle');
	container.attr('data-status', $(this).attr('data-open'));
	toggle.change(container);
});
