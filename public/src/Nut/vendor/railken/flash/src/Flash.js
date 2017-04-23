var Flash = function()
{


};

Flash.prototype.show = function(type, message)
{

	// Are we in a modal? Prompt the error in modal

	// Not? Prompt the message as a notice
	
	alert(message);
}

Flash.prototype.success = function(message)
{
	this.show('success', message);
}

Flash.prototype.error = function(message)
{
	this.show('error', message);
}