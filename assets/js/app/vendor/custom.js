$(document).ready(function(){		
	$('#vendorData').dataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': base_url + 'store/vendor',
		'columns': [
			{ data: 'vendor_id' },
			{ data: 'vendor_name' },
			{ data: 'vendor_phone' },
			{ data: 'vendor_email' },
			{ data: 'vendor_address' },
			{ data: 'operation' },
		],
		'columnDefs': [{ 
			"targets": [ -1 ], 
			"orderable": false, 
		}]
	}); 
	
	//GET ITEM FOR EDIT***
	$('#show_data').on('click','.item_edit',function(){
		var vendor_id = $(this).attr('data');
		if(!isEmpty(vendor_id)){
			var form_data = {
				vendor_id: vendor_id,
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type : "GET",
				url  : base_url + "store/get-vendor",
				dataType : "JSON",
				data : form_data,
				success: function(data){
					$.each(data,function(vendor_id, vendor_name, vendor_phone, vendor_address){
						$('[name="vendor_id"]').val(data.vendor_id);
						$('[name="vendor_name"]').val(data.vendor_name);
						$('[name="vendor_phone"]').val(data.vendor_phone);
						$('[name="vendor_email"]').val(data.vendor_email);
						$('[name="vendor_address"]').val(data.vendor_address);
						$('[name="vendor_form_btn"]').val("edit").text("Edit Vendor");
					});
				}
			});
			return false;
		}else{
			console.log("vendor Information Show Nothing");
		}
	});


	//GET***
	$('#show_data').on('click','.item_delete',function(){
		var id = $(this).attr('data');
		$('#vendor_modal').modal('show');
		$(".print-error-msg").css('display','none');
		$(".print-warning-msg").css('display','block');
		$('[name="vendor_id_for_delete"]').val(id);
	});

	//Create Update vendor***
	$('#form_new_vendor_data').on('submit', function(e){
		e.preventDefault();
		$('[name="vendor_form_btn"]').prop('disabled', true); // disable button
		
		var vendor_id = $('[name="vendor_id"]').val();
		var vendor_name = $('[name="vendor_name"]').val();
		var vendor_phone = $('[name="vendor_phone"]').val();
		var vendor_email = $('[name="vendor_email"]').val();
		var vendor_address = $('[name="vendor_address"]').val();
		var vendor_btn = $('[name="vendor_form_btn"]').val();
		
		if(!isEmpty(vendor_name) && !isEmpty(vendor_phone) && !isEmpty(vendor_email) && !isEmpty(vendor_address)){
			var form_data = {
				vendor_name: vendor_name,
				vendor_phone: vendor_phone,
				vendor_email: vendor_email,
				vendor_address: vendor_address,
				vendor_btn: vendor_btn,
			};
			if(!isEmpty(vendor_id) && (vendor_btn=="edit")){
				form_data["vendor_id"] = vendor_id;
			}
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type : "POST",
				url  : base_url + "store/update-vendor",
				dataType : "JSON",
				data : form_data,
				success: function(data){
					//for server side validation***
					//if($.isEmptyObject(data.error)){
					//	$(".print-error-msg").css('display','none');
						$('[name="vendor_id"]').val("");
						$('[name="vendor_name"]').val("");
						$('[name="vendor_phone"]').val("");
						$('[name="vendor_email"]').val("");
						$('[name="vendor_address"]').val("");
						$('[name="vendor_form_btn"]').val("add").text("Add Vendor");
						$('#vendorData').DataTable().ajax.reload();
						$('[name="vendor_form_btn"]').prop('disabled', false);
					//}else{
					//	$(".print-error-msg").css('display','block');
					//	$(".print-error-msg").html(data.error);
					//}
				}
			});
			return false;
		}else{
			console.log("Vendor Information Add Nothing");
		}
	});

	//Delete vendor***
	$('#btn_delete').on('click',function(e){
		e.preventDefault();
		var vendor_id = $('[name="vendor_id_for_delete"]').val();
		
		if(!isEmpty(vendor_id)){
			var form_data = {
				vendor_id: vendor_id,
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type : "POST",
				url  : base_url + "store/delete-vendor",
				dataType : "JSON",
				data : form_data,
				success: function(data){
					if($.isEmptyObject(data.error_message)){
						$(".print-error-msg").css('display','none');
						$('#vendor_modal').modal('hide');
						$('#vendorData').DataTable().ajax.reload();
					}else{
						$(".print-warning-msg").css('display','none');
						$(".print-error-msg").css('display','block');
						$(".print-error-msg").html(data.error_message);
						$('#btn_delete').prop('disabled', true);
					}
				}
			});
			return false;
		}else{
			console.log("Vendor Information Delete Nothing");
		}
	});
	
	$("#reset_vendor_form").on('click',vendor_form_clear);
});

function vendor_form_clear(){
	location.reload();
}

//update token
$("form").submit(function () {
	$("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});