var template = {};

/**
 * List of all vars used in sources
 *
 * @var array
 */
template.vars = [];

/**
 * List of all source template
 *
 * @var {array}
 */
template.source = {};

template.parts = [];

template.define = function(name)
{

	
	var tmpl = new TemplatePart();

	this.parts[name] = tmpl;

	return tmpl;

}


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
 * load a template
 *
 * @param {string} source template
 *
 * @return void
 */
template.load = function(name)
{	

	try {
		var templates = this.parts[name].load();
	} catch (e) {
		return null;

	}

	templates.map(function(part) {

		var container = part._container();

		container.html(template.get(part._source, part._vars));

		part._ready();

	});

}


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

var TemplatePart = function()
{

	this.children = [];
	this._ready = function(){};
};

TemplatePart.prototype.target = function(target)
{
	this._target = target;
	return this;
};

TemplatePart.prototype.container = function(container)
{
	this._container = container;
	return this;
};

TemplatePart.prototype.vars = function(vars)
{
	this._vars = vars;
	return this;
};

TemplatePart.prototype.source = function(source)
{
	this._source = source;
	return this;
};

TemplatePart.prototype.parent = function(parent)
{
	parent.children.push(this);
	this._parent = parent;
	return this;
};

TemplatePart.prototype.ready = function(ready)
{
	this._ready = ready;
	return this;
};

TemplatePart.prototype.load = function()
{
	var templates = [this];

	for (i in this.children) {
		templates.push(this.children[i]);
	}
	return templates;

};