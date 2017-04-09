var CookieStorage = function(name)
{	
	/**
	 * Name
	 *
	 * @var {string}
	*/
	this.name = name;
};

/**
 * Set value
 *
 * @param {string} value
 *
 * @return void
 */
CookieStorage.prototype.set = function(value)
{
	$.cookie(this.name, value);
};

/**
 * Get value
 *
 * @param {string} value   default value
 *
 * @return {string}
 */
CookieStorage.prototype.get = function(value)
{
	if(!value)
		value = null;

	var cookie = $.cookie(this.name);

	return cookie ? cookie : value;
};

/**
 * Remove from storage
 *
 * @return void
 */
CookieStorage.prototype.remove = function()
{
	$.removeCookie(this.name);
};