function uiErrorMessage(msg, status){
	UIkit.notification({
	    message: msg,
	    status: status,
	    pos: 'top-center',
	    timeout: 10000
	});
}

function debug_function(message)
{
	console.log(message);
}

function submitMessageForm()
{
	var data = {
		'name': jQuery('#name').val(),
		'email': jQuery('#email').val(),
		'account': jQuery('#account').val(),
		'type': jQuery('#type').val(),
		'message': jQuery('#message').val()
	};
	var submit = jQuery.ajax({
		url: 'index.php?option=com_ajax&module=staffspotlight&format=raw&method=submitMessage',
		type: 'POST',
		data: data,
		dataType: 'json',
		beforeSend: function(){
			console.log(data);
		}
	}).done(function(data){
		console.log(data);
		if(data.success){
			jQuery('#contact-form > form').hide();
			jQuery('#contact-form').append(data.data);
		}
	}).error(function(xhr, textStatus, error){
		console.log(xhr);
		console.log(textStatus);
		console.log(error);
	});
}

jQuery(document).on('click', '#submit-contact-form', function(e){
	e.preventDefault();
	submitMessageForm();
});