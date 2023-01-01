<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class PurchaseOrder extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
		$data['title'] = "Purchase Order Information";
		$data['vendors'] = $this->vm->vendor_list();

		$this->load->view('includes/_header', $data);
        $this->load->view('home');
        $this->load->view('includes/_footer');
    }

	function purchase_order_list(){
		//$data = $this->pom->get_purchase();
		//print_r($data);exit;
		$postData = $this->input->post();
		$data = $this->pom->get_purchase_orders($postData);
		echo json_encode($data);
	}

	function get_purchase_order_data(){
		$purchase_order_id = $this->input->get('purchase_order_id');
		$result = $this->pom->get_purchase_order_by_id($purchase_order_id);
		echo json_encode($result);
	}

	function create_update_purchase_order(){
		$purchase_order_btn = $this->input->post('purchase_order_btn', true);
		$purchase_order_id = $this->input->post('purchase_order_id', true);
		$data = $this->pom->input_values();
		//echo $purchase_order_btn.'~'.$purchase_order_id;exit;
		
		$result = array();
		if(($purchase_order_btn == 'add')&&(!isset($purchase_order_id))){
			unset($data['purchase_order_id']);
			$result = $this->pom->add_purchase_order($data);
		}elseif(($purchase_order_btn == 'edit')&&(isset($purchase_order_id))){
			$data['purchase_order_id'] = $purchase_order_id;
			$result = $this->pom->update_purchase_order($data);
		}
		echo json_encode($result);
	}

	function delete_purchase_order(){
		$purchase_order_id = $this->input->post('purchase_order_id');
		$result = $this->pom->delete_purchase_order($purchase_order_id);
		echo json_encode($result);
	}
	
}

/* End of file purchase_order.php */
/* Location: ./application/modules/purchase-order/controllers/purchase_order.php */