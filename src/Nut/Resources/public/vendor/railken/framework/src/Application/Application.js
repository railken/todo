var Application = function()
{

	/**
	 * List of all providers that must be loaded before the displaying
	 * Why this? Cause before load the page
	 * all libraries must be initialized
	 *
	 * @var {ArrayObject}
	 */
	this.providers = [];

	/**
	 * Instance of api
	 *
	 * @var {Api}
	 */
	this.api = new Api();

	/**
	 * Instance client
	 *
	 * @var {Client}
	 */
	this.client = new Client();

	/**
	 * Current route
	 *
	 * @var {string}
	 */
	this.route = null;

	/**
	 * List of all vars
	 *
	 * @var {Array}
	 */
	this.vars = [];

	/**
	 * Get service
	 *
	 * @param {string} name
	 *
	 * @return mixed
	 */
	this.get = function(name)
	{
		return this.vars[name];
	};

	/**
	 * Set service
	 *
	 * @param {string} name
	 * @þaram {mixed} value
	 *
	 * @return this
	 */
	this.set = function(name, value)
	{
		this.vars[name] = value;
		
		return this;
	}


	/**
	 * List of all listeners
	 */
	this.events = [];
};

/**
 * Add a provider
 *
 * @param {string} name
 * @param {closure} provider
 *
 * @return void
 */
Application.prototype.addProvider = function(name, provider)
{
	this.providers.push({
		name: name,
		provider: provider
	});
};

/**
 * Add a providers
 *
 * @param {string} name
 * @param {closure} callback
 *
 * @return void
 */
Application.prototype.addProviders = function(providers)
{

	for (index in providers) {
		provider = new providers[index];
		provider.name;

		this.addProvider(provider.name, provider);
	}

};


/**
 * Execute all providers
 *
 * @return void
 */
Application.prototype.executeProviders = function()
{
	this.executeProvider(0);
};



/**
 * Execute a provider
 *
 * @param {string} name
 * @param {string} next
 *
 * @return void
 */
Application.prototype.executeProvider = function(index)
{

	
	var self = this;

	if (this.providers[index] == undefined)
		return;

	var provider = this.providers[index].provider;

	// Send a callback to execute the next provider when the service has ended execution
	provider.initialize(provider, function(){
	
		self.executeProvider(index+1);
	});

};

/**
 * Get the api instance
 *
 * @return {Api}
 */
Application.prototype.getApi = function()
{
	return this.api;
};

/**
 * Get client
 *
 * @return {Client}
 */
Application.prototype.getClient = function()
{
	return this.client;
};

/**
 * Initialize the application
 *
 * @return void
 */
Application.prototype.init = function()
{
	this.executeProviders();
};

/**
 * Display the application
 *
 * @return void
 */
Application.prototype.display = function()
{

};


/**
 * Set route
 *
 * @param {string} url
 *
 * @return {this}
 */
Application.prototype.setRoute = function(route)
{
	this.route = route;

	return this;
};

/**
 * Get route
 *
 * @return {string}
 */
Application.prototype.getRoute = function()
{
	return this.route;
};

/**
 * Is route
 *
 * @param {string} route
 *
 * @return boolean
 */
Application.prototype.isRoute = function(route)
{
	return this.getRoute() == route;
};

/**
 * Redirect to
 *
 * @param {string}
 *
 * @return void
 */
Application.prototype.redirectTo = function(url)
{
	return window.location.href = url;
}

Application.prototype.addListener = function(event, callback)
{

	if (!this.events[event]) {
		this.events[event] = [];
	}

	this.events[event].push(callback);
}

/**
 * Fire event
 *
 * @param name event
 *
 * @return void
 */
Application.prototype.fireEvent = function(event)
{

	if (!this.events[event])
		return;

	var callback;

	for (i in this.events[event]) {
		callback = this.events[event][i];

		callback();
	}
}