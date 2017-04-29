String.prototype.startsWith = function(needle)
{
    return(this.indexOf(needle) == 0);
};

Object.defineProperty(Array.prototype, 'getByAttribute', {
    enumerable: false,
    value: function(attribute, value)
	{
		for (i in this) {
			if (this[i][attribute] == value)
				return this[i];
		}

		return null;
	}
});

Object.defineProperty(Array.prototype, 'findByAttribute', {
    enumerable: false,
    value: function(attribute, value)
	{
		for (i in this) {
			if (this[i][attribute] == value)
				return i;
		}

		return null;
	}
});

Object.defineProperty(Array.prototype, 'removeByAttribute', {
    enumerable: false,
    value:  function(attribute, value)
	{
		var index = this.findByAttribute(attribute, value);
		return index !== null ? this.remove(index) : null;
	}	
});

Object.defineProperty(Array.prototype, 'remove', {
    enumerable: false,
    value: function(index)
	{
		return this.splice(index, 1);
	}
});

function collect(array) {


	return array;
}