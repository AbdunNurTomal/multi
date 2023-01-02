<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-header">
		<div>
			<h3 class="box-title"><?php echo $title; ?></h3>
			<button class="button" id="reset_vendor_form" style="vertical-align:middle;color:blue;">
				<span><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;from</span>
			</button>
		</div>
		<div style="padding-top: 20px;">
			<a href="<?= base_url().'store/purchase-order'; ?>" class="btn btn-warning btn-add-new">
				<i class="fa fa-bars"></i>
				<?php echo "Purchase Order"; ?>
			</a>
		</div>
	</div>
	<hr>
	<div class="box-body">
		<div class="row">
			<form id="form_new_vendor_data">
				<input type="hidden" name="vendor_id"/>
				<div class="row">
					<div class="form-group col-sm-4">
						<label>Vendor&nbsp;Name&nbsp;:&nbsp;</label>
						<input type="text" name="vendor_name" class="form-control form-input" placeholder="<?php echo "Name"; ?>" value="" required>
					</div>
					<div class="col-sm-4">
						<label>Vendor&nbsp;Phone&nbsp;:&nbsp;</label>
						<input type="phone" name="vendor_phone" class="form-control form-input" placeholder="<?php echo "Phone Number"; ?>" value="" required>
					</div>
					<div class="col-sm-4">
						<label>Vendor&nbsp;Email&nbsp;:&nbsp;</label>
						<input type="email" name="vendor_email" class="form-control form-input" placeholder="<?php echo "Email"; ?>" value="" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<label>Vendor&nbsp;Address&nbsp;:&nbsp;</label>
						<input type="text" name="vendor_address" class="form-control form-input" placeholder="<?php echo "Address"; ?>" value="" required>
					</div>
					<div class="col-sm-2" style="padding-top: 25px;">
						<button type="submit" class="btn btn-primary pull-right" name="vendor_form_btn" value="add">Add Vendor</button>
					</div>
				</div>
			</form>
		</div>
		<hr>

		<div class="row">
			<div id="reload">
			<table class="table table-striped" id="vendorData">
				<thead>
					<tr>
						<th>ID</th>
						<th>vendor Name</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Address</th>
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
<?php $this->load->view('_vendor-modal'); ?>

<script type="text/javascript" src="<?php echo base_url().'assets/js/app/vendor/custom.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/app/vendor/custom-validate.js'?>"></script>
