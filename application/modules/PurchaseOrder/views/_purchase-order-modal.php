<!--MODAL DELETE-->
<div class="modal fade" id="purchase_order_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Purchase Order</h4>
			</div>
			<form class="form-horizontal">
			<div class="modal-body"> 
				<input type="hidden" name="purchase_order_for_delete">
				<div class="alert alert-warning"><p>Do you want to delete this Purchase Order ?</p></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn_delete btn btn-danger" id="btn_delete">Delete</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL DELETE-->
