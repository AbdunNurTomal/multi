function validate_name(){
	var name = $('[name="vendor_name"]').val();
	if (name.length < 2 || !/^[A-Za-z\s]+$/.test(name)) { 
		var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>Name length must be greter then 2 and only character</div>';
		$('[name="vendor_name"]').focus();
		if($('input[name="vendor_name"] + div.alert.alert-danger').length == 0) {
		  $('[name="vendor_name"]').after(message);
		}
	}else{
		$('input[name="vendor_name"] + div.alert.alert-danger').remove();
	}
}

function validate_email(){
	var email = $('[name="vendor_email"]').val();
	if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) { 
		var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>Please enter an email with proper formet</div>';
		$('[name="vendor_email"]').focus();
		if($('input[name="vendor_email"] + div.alert.alert-danger').length == 0) {
			$('[name="vendor_email"]').after(message);
		}
	}else{
		$('input[name="vendor_email"] + div.alert.alert-danger').remove();
	}
}

function validate_phone(){
	var phone_no = $('[name="vendor_phone"]').val();
	if (!/^\+?([0]{1})\)?([0-9]{9,10})$/.test(phone_no) && !/^\+?([88]{2})\)?([0-9]{9,10})$/.test(phone_no) ) {
		var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>Please fill your proper phno with +88 Or 0</div>';
		$('[name="vendor_phone"]').focus();
		if($('input[name="vendor_phone"] + div.alert.alert-danger').length == 0) {
			$('[name="vendor_phone"]').after(message);
		}
	}else{
	  $('input[name="vendor_phone"] + div.alert.alert-danger').remove();
	}
}

function isEmpty(value) {
	return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}