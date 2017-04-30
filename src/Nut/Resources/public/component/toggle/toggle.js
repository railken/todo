var toggle = {};

toggle.open = function(t, panel)
{

	if (t.attr('data-status') == panel)
		return;

	t.attr('data-status', panel);

	var container = t.attr('data-container');

	if (container) {
		$.map($(".toggle[data-container='"+container+"']"), function(el) {
			$(el).find("[data-panel]").hide();
			$(el).find("[data-panel='1']").show();
		});
	}

	t.find("[data-panel]").hide();
	t.find("[data-panel='"+panel+"']").show();
};

toggle.save = function()
{	

	toggle.vars = [];

	$(".toggle").each(function(index) {
		toggle.vars[index] = $(this).attr('data-status');
	});
}

toggle.rollback = function()
{	
	$(".toggle").each(function(index) {
		toggle.open($(this), toggle.vars[index]);
	});
}

toggle.reload = function()
{

	$.map($('.toggle'), function(el) {
		var status = $(el).attr('data-status');
		$(el).attr('data-status', 0);

		toggle.open($(el), status);
	});
}

$('body').on('click', "[data-open]", function() {

	var container = $(this).closest('.toggle');
	toggle.open(container, $(this).attr('data-open'));
});
