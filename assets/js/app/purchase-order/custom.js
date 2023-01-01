$(document).ready(function(){		
	$('#purchaseOrderData').dataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': base_url + 'store/purchase-order/list',
		'columns': [
			{ data: 'purchase_order_id' },
			{ data: 'item_name' },
			{ data: 'vendor_name' },
			{ data: 'item_quantity' },
			{ data: 'unit_price' },
			{ data: 'total_price' },
			{ data: 'operation' },
		],
		'columnDefs': [{ 
			"targets": [ -1 ], 
			"orderable": false, 
		}]
	}); 
	
	//GET ITEM FOR EDIT***
	$('#show_data').on('click','.item_edit',function(){
		var purchase_order_id = $(this).attr('data');
		if(!isEmpty(purchase_order_id)){
			var form_data = {
				purchase_order_id: purchase_order_id,
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type : "GET",
				url  : base_url + "store/get-purchase-order",
				dataType : "JSON",
				data : form_data,
				success: function(data){
					$.each(data,function(purchase_order_id, vendor_id, item_name, item_quantity, unit_price, total_price){
						$('[name="purchase_order_id"]').val(data.purchase_order_id);
						$('[name="vendor_id"]').val(data.vendor_id).change();
						$('[name="item_name"]').val(data.item_name);
						$('[name="item_quantity"]').val(data.item_quantity);
						$('[name="unit_price"]').val(data.unit_price);
						$('[name="total_price"]').val(data.total_price);
						$('[name="purchase_order_form_btn"]').val("edit").text("Edit Purchase Order");
					});
				}
			});
			return false;
		}else{
			console.log("Purchase Order Information Show Nothing");
		}
	});


	//GET***
	$('#show_data').on('click','.item_delete',function(){
		var id=$(this).attr('data');
		$('#purchase_order_modal').modal('show');
		$('[name="purchase_order_for_delete"]').val(id);
	});

	//Create Update vendor***
	$('#form_new_purchase_order_data').on('submit', function(e){
		e.preventDefault();

		var purchase_order_id = $('[name="purchase_order_id"]').val();
		var vendor_id = $('[name="vendor_id"]').find("option:selected").val();
		var item_name = $('[name="item_name"]').val();
		var item_quantity = $('[name="item_quantity"]').val();
		var unit_price = $('[name="unit_price"]').val();
		var total_price = $('[name="total_price"]').val();
		var purchase_order_btn = $('[name="purchase_order_form_btn"]').val();
		
		if(!isEmpty(vendor_id) && !isEmpty(item_name) && !isEmpty(item_quantity) && !isEmpty(unit_price) && !isEmpty(total_price)){
			var form_data = {
				vendor_id: vendor_id,
				item_name: item_name,
				item_quantity: item_quantity,
				unit_price: unit_price,
				total_price: total_price,
				purchase_order_btn: purchase_order_btn,
			};
			if(!isEmpty(purchase_order_id) && (purchase_order_btn=="edit")){
				form_data["purchase_order_id"] = purchase_order_id;
			}
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type : "POST",
				url  : base_url + "store/update-purchase-order",
				dataType : "JSON",
				data : form_data,
				success: function(data){
					if($.isEmptyObject(data.error)){
						$(".print-error-msg").css('display','none');
						$('[name="vendor_id"]').val("").change();
						$('[name="item_name"]').val("");
						$('[name="item_quantity"]').val("");
						$('[name="unit_price"]').val("");
						$('[name="total_price"]').val("");
						$('[name="purchase_order_form_btn"]').val("add").text("Add Purchase Order");
						$('#purchaseOrderData').DataTable().ajax.reload();
					}else{
						$(".print-error-msg").css('display','block');
						$(".print-error-msg").html(data.error);
					}
				}
			});
			return false;
		}else{
			console.log("Purchase Order Information Add Nothing");
		}
	});

	//Delete Purchase Order***
	$('#btn_delete').on('click',function(e){
		e.preventDefault();
		var purchase_order_id = $('[name="purchase_order_for_delete"]').val();
		
		if(!isEmpty(purchase_order_id)){
			var form_data = {
				purchase_order_id: purchase_order_id,
			};
			form_data[csfr_token_name] = $.cookie(csfr_cookie_name);
			
			$.ajax({
				type : "POST",
				url  : base_url + "store/delete-purchase-order",
				dataType : "JSON",
				data : form_data,
				success: function(data){
						$('#purchase_order_modal').modal('hide');
						$('#purchaseOrderData').DataTable().ajax.reload();
				}
			});
			return false;
		}else{
			console.log("Purchase Order Information Delete Nothing");
		}
	});
	
	$('input[name="item_quantity"]').on('keyup',calculate_total_price);
	$('input[name="unit_price"]').on('keyup',calculate_total_price);
	
	$("#resset_purchase_order_form").on('click',purchase_order_form_clear);
});

function purchase_order_form_clear(){
	$(".print-error-msg").css('display','none');
	$('[name="purchase_order_id"]').val("");
	$('[name="vendor_id"]').val("");
	$('[name="item_name"]').val("");
	$('[name="item_quantity"]').val("");
	$('[name="unit_price"]').val("");
	$('[name="total_price"]').val("");
	$('[name="purchase_order_form_btn"]').val("add").text("Add Purchase Order");
}

//update token
$("form").submit(function () {
	$("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});

function calculate_total_price(){	
	var itemQuantity = $('[name="item_quantity"]').val();
	var unitPrice = $('[name="unit_price"]').val();
	
	if(!isEmpty(itemQuantity) && !isEmpty(unitPrice)){
		$('[name="total_price"]').val(roundToTwo(roundToTwo(itemQuantity) * roundToTwo(unitPrice)));
	}else{
		$('[name="total_price"]').val("");
	}
}