<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-header">
		<div>
			<h3 class="box-title"><?= $title; ?></h3>
			<button class="button" id="resset_purchase_order_form" style="vertical-align:middle;color:blue;">
				<span><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;from</span>
			</button>
		</div>
		<div style="padding-top: 20px;">
			<a href="<?= base_url(); ?>" class="btn btn-warning btn-add-new">
				<i class="fa fa-bars"></i>
				<?php echo "Vendor"; ?>
			</a>
		</div>
	</div>
	<hr>
	<div class="box-body">
		<div class="row">
			<form id="form_new_purchase_order_data">
				<input type="hidden" name="purchase_order_id"/>
				<div class="row">
					<div class="form-group col-sm-6">
						<label>Item&nbsp;Name&nbsp;:&nbsp;</label>
						<input type="text" name="item_name" class="form-control form-input" placeholder="<?php echo "Item Name"; ?>" required>
					</div>
					<div class="col-sm-6">
						<label>Vendor&nbsp;Name&nbsp;:&nbsp;</label>
						<select name="vendor_id" class="form-control">
							<option value="" selected>Select vendor name</option>
							<?php foreach ($vendors as $vendor): ?>
								<option value="<?php echo $vendor->vendor_id; ?>"><?php echo ($vendor->vendor_name!='')? $vendor->vendor_name:'none'; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label>Item&nbsp;Quantity&nbsp;:&nbsp;</label>
						<input type="number" name="item_quantity" class="form-control form-input" placeholder="<?php echo "Quantity"; ?>" required>
					</div>
					<div class="col-sm-3">
						<label>Unit&nbsp;Price&nbsp;:&nbsp;</label>
						<input type="decimal" name="unit_price" class="form-control form-input" placeholder="<?php echo "Price"; ?>" required>
					</div>
					<div class="col-sm-4">
						<label>Total&nbsp;Price&nbsp;:&nbsp;</label>
						<input type="decimal" name="total_price" class="form-control form-input" placeholder="<?php echo "Total"; ?>" tabindex="-1" readonly required>
					</div>
					<div class="col-sm-2" style="padding-top: 25px;">
						<button type="submit" class="btn btn-primary pull-right" name="purchase_order_form_btn" value="add">Add Puchase Order</button>
					</div>
				</div>
			</form>
		</div>
		<hr>

		<div class="row">
			<div id="reload">
			<table class="table table-striped" id="purchaseOrderData">
				<thead>
					<tr>
						<th>ID</th>
						<th>Item Name</th>
						<th>Vendor Name</th>						
						<th>Quantity</th>
						<th>Price</th>
						<th>Total Price</th>
						<th style="text-align: right;">Operation</th>
					</tr>
				</thead>
				<tbody id="show_data">
					
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('_purchase-order-modal'); ?>

<script type="text/javascript" src="<?php echo base_url().'assets/js/app/purchase-order/custom.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/app/purchase-order/custom-validate.js'?>"></script>
