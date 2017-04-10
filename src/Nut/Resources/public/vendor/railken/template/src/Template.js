var template = {};

/**
 * List of all source template
 *
 * @var {array}
 */
template.source = {};

/**
 * Set html using a template
 *
 * @param {string} source template
 * @param {object} vars
 * @param {string} destination
 */
template.set = function(source, vars, destination)
{

	var html = template.get(source,vars);

	template.html(html,destination);
};

/**
 * Set html using a string
 *
 * @param {string} html
 * @param {string} destination
 */
template.html = function(html, destination)
{

	$(destination).html(html);
	
	setTimeout(function() {
		$('.template-new').removeClass('template-new');
   	}, 50);
};

/**
 * Get html using template source and vars
 *
 * @param {string} source template
 * @param {object} vars
 *
 * @return {string} html
 */
template.get = function(source, vars)
{

	var source = template.getSource(source).html();

	
	Mustache.parse(source, ['{','}']);
	var rendered = Mustache.render(source, vars);

	return rendered;

};


/**
 * Get source DOM given name
 *
 * @param {string} source name template
 *
 * @return {DOM}
 */
template.getSource = function(source)
{

	var source = $.parseHTML("<div>"+template.source[source]+"</div>");
	source = $(source);
	source.children().addClass('template-new');
	return source.clone();
};

/**
 * Initalize
 *
 * Search for all templates, save them and delete from html
 */
$(document).ready(function()
{
	$.map($("template"),function(tmpl){
		tmpl = $(tmpl);
		var name = tmpl.attr('data-name');
		template.source[name] = tmpl.html();
		tmpl.remove();
	});
});