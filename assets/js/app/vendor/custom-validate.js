$(document).ready(function() {
	$('[name="vendor_name"]').on("input", function(e) {
		$('input[name="vendor_name"] + div.alert.alert-danger').remove();
		
		var name = $('[name="vendor_name"]').val();
		if (name.length < 2 || !/^[A-Za-z\s]+$/.test(name)) { 
			var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>Name length must be greter then 2 and only character</div>';
			$('[name="vendor_name"]').focus();
			if($('input[name="vendor_name"] + div.alert.alert-danger').length == 0) {
				$('[name="vendor_name"]').after(message);
			}
		}else {
			$('input[name="vendor_name"] + div.alert.alert-danger').remove();
			var vendor_name = $('[name="vendor_name"]').val();
			var form_data = {
				vendor_name: vendor_name
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type: "GET",
				url: base_url + "store/get-vendor-name-availability",
				dataType: "JSON",
				data: form_data,
				cache: false,
				success: function(data) {
					if(!$.isEmptyObject(data.error_message)){
						$('[name="vendor_name"]').focus();
						var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>'+data.error_message+'</div>';
						$('[name="vendor_name"]').after(message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('[name="vendor_name"]').focus();
					var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>'+textStatus + " " + errorThrown+'</div>';
					$('[name="vendor_name"]').after(message);
				}
			});
		}
	});
	
	$('[name="vendor_email"]').on("input", function(e) {
		$('input[name="vendor_email"] + div.alert.alert-danger').remove();
		
		var email = $('[name="vendor_email"]').val();
		if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) { 
			var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>Please enter an email with proper formet</div>';
			$('[name="vendor_email"]').focus();
			if($('input[name="vendor_email"] + div.alert.alert-danger').length == 0) {
				$('[name="vendor_email"]').after(message);
			}
		}else{
			$('input[name="vendor_email"] + div.alert.alert-danger').remove();
			var vendor_email = $('[name="vendor_email"]').val();
			var form_data = {
				vendor_email: vendor_email
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type: "GET",
				url: base_url + "store/get-vendor-email-availability",
				dataType: "JSON",
				data: form_data,
				cache: false,
				success: function(data) {
					if(!$.isEmptyObject(data.error_message)){
						$('[name="vendor_email"]').focus();
						var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>'+data.error_message+'</div>';
						$('[name="vendor_email"]').after(message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('[name="vendor_email"]').focus();
					var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>'+textStatus + " " + errorThrown+'</div>';
					$('[name="vendor_email"]').after(message);
				}
			});
		}
	});
	
	$('[name="vendor_phone"]').on("input", function(e) {
		$('input[name="vendor_phone"] + div.alert.alert-danger').remove();
		
		var phone_no = $('[name="vendor_phone"]').val();
		if (!/^\+?([0]{1})\)?([0-9]{9,10})$/.test(phone_no) && !/^\+?([88]{2})\)?([0-9]{9,10})$/.test(phone_no) ) {
			var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>Please fill your proper phno with +88 Or 0</div>';
			$('[name="vendor_phone"]').focus();
			if($('input[name="vendor_phone"] + div.alert.alert-danger').length == 0) {
				$('[name="vendor_phone"]').after(message);
			}
		}else{
			$('input[name="vendor_phone"] + div.alert.alert-danger').remove();
			var vendor_phone = $('[name="vendor_phone"]').val();
			var form_data = {
				vendor_phone: vendor_phone
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type: "GET",
				url: base_url + "store/get-vendor-phone-availability",
				dataType: "JSON",
				data: form_data,
				cache: false,
				success: function(data) {
					if(!$.isEmptyObject(data.error_message)){
						$('[name="vendor_phone"]').focus();
						var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>'+data.error_message+'</div>';
						$('[name="vendor_phone"]').after(message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('[name="vendor_phone"]').focus();
					var message = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">×</a>'+textStatus + " " + errorThrown+'</div>';
					$('[name="vendor_phone"]').after(message);
				}
			});
		}
	});
});

function isEmpty(value) {
	return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}