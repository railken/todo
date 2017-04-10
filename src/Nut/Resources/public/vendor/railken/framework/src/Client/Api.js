var Api = function(){

	/**
	 * Token used to identify the user in OAuth2
	 *
	 * @var {string}
	 */
	this.token = null;

	/**
	 * Api URL
	 *
	 * @var {string}}
	 */
	this.url = null;
};

/**
 * Set the token
 *
 * @param {string} token
 *
 * @return this;
 */
Api.prototype.setToken = function(token)
{
	this.token = token;

	return this;
};

/**
 * Get the token
 *
 * @return this;
 */
Api.prototype.getToken = function()
{
	return this.token;
};


/**
 * Set the url
 *
 * @param {string} url
 *
 * @return this;
 */
Api.prototype.setUrl = function(url)
{
	this.url = url;

	return this;
};

/**
 * Get the url
 *
 * @return this;
 */
Api.prototype.getUrl = function()
{
	return this.url;
};

/**
 * Stack call api
 *
 * @var object
 */
Api.prototype.stackCall = [];

/**
 * Make a call to api
 *
 * @param {string} method
 * @param {string} url
 * @param {object} params
 * @param {closure} callback
 *
 * @return void
 */
Api.prototype.call = function(method, url, params, callback){

	var self = this;

	var vars = {
		url: url,
		method: method,
		params: params,
		callback: callback
	};

	for (var index in this.stackCall) {
		
		var call = this.stackCall[index];

		// Don't spam the same call!!!
		if (call.vars == vars) {
			return;
		}
	}

	self.stackCall.push({
		vars: vars,
		call: function() {
			self.__call(method, url, params, callback);
		}	
	});


	if (self.stackCall.length <= 1) {
		self.stackDone(null);
	}
};


Api.prototype.callFirst = function()
{
	for (var index in this.stackCall) {
		
		var call = this.stackCall[index];

		call.call();

		$('body').attr('loading', 1);
		return true;

	}

	$('body').attr('loading', 0);
	return false;
};

Api.prototype.stackDone = function(url)
{		
	if (url) {


		for (var index in this.stackCall) {

			if (this.stackCall[index].vars.url == url) {

				this.stackCall.splice(index, 1);
			};
		}
	}

	this.callFirst();
};


/**
 * Make a call to api
 *
 * @param {string} method
 * @param {string} url
 * @param {object} params
 * @param {closure} callback
 *
 * @return void
 */
Api.prototype.__call = function(method, url, params, callback){


	var headers = {};
	var base_url = url;
	var url = this.getUrl()+url;


	// Now. Every all
	
	var self = this;

	if (this.getToken() != null) {
		params.access_token = this.getToken();
		headers['Authorization'] = 'Bearer '+this.getToken();
	}


	if (method == 'GET') {
		url += "?"+$.param(params);
	}

	var call = {
		type: method,
		url: url, 
		data : params,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		success: function(response) {
			self.stackDone(base_url);

			console.log(response);
			callback(response);
		},
		error: function(jqXHR, textStatus, errorThrown) {

			self.stackDone(base_url);

			// If response is still in json than is still valid
			if (jqXHR && jqXHR.responseJSON) {

				callback(jqXHR.responseJSON);

			} else {

				console.log('Error during call: '+url);
				console.log(jqXHR);
				console.log(params);
				console.log(errorThrown);

				callback();

			}
		},
		dataType:'json',
		headers: headers
	};

	
	return $.ajax(call);
};

/**
 * Fetch the response with call info
 *
 * @param {object} response
 * @param {object} call
 *
 * @¶eturn void
 */
Api.prototype.fetchResponse = function(response, call)
{

	if (!response) {

		if (call.fatal) {
			
			call.fatal();

		} else {
			
			call.error();

		}

		return;
	}
	
	/** Basic API **/
	if(response.status == 'success' && call.success != undefined) {
		call.success(response);
		return;
	}
	
	if(response.status == 'error' && call.error != undefined) {

		call.error(response);
		return;
	}

	if(response.error != undefined) {

		call.error(response);
		return;
	}


};

/**
 * Call basic 
 *
 * @param {string} method
 * @param {string} url
 * @param {object} call
 *
 * @return void
 */
Api.prototype.basicCall = function(method, url, call)
{
	var self = this;
	var params = call.params != undefined ? call.params : {};

	self.call(method, url, params, function(response) {

		self.fetchResponse(response, call);

	});
}