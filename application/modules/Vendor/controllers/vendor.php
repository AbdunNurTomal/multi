<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Vendor extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
		$data['title'] = "Vendor Information";
		
		$this->load->view('includes/_header', $data);
        $this->load->view('home');
        $this->load->view('includes/_footer');
    }

	function vendor_list(){
		$postData = $this->input->post();
		$data = $this->vm->get_vendors($postData);
		echo json_encode($data);
	}

	function get_vendor_data(){
		$vendor_id = $this->input->get('vendor_id');
		$result = $this->vm->get_vendor_by_id($vendor_id);
		echo json_encode($result);
	}

	function create_update_vendor(){
		$vendor_btn = $this->input->post('vendor_btn', true);
		$vendor_id = $this->input->post('vendor_id', true);
		$data = $this->vm->input_values();
		
		//echo $vendor_btn.'~'.$vendor_id;exit;
		
		$result = array();
		if(($vendor_btn == 'add')&&(!isset($vendor_id))){
			$data['vendor_id'] = '';
			$result = $this->vm->add_vendor($data);
		}elseif(($vendor_btn == 'edit')&&(isset($vendor_id))){
			$data['vendor_id'] = $vendor_id;
			$result = $this->vm->update_vendor($data);
		}
		echo json_encode($result);
	}

	function delete_vendor_by_id(){
		$vendor_id = $this->input->post('vendor_id');
		$result = array();
		if(count(check_purchase_order_exist($vendor_id))>0){
			$result = array('error_message' => 'Purchase Order Exist..you can not delete this vendor');
		}else{
			$result = $this->vm->delete_vendor($vendor_id);
		}
		echo json_encode($result);
	}
	
}

/* End of file vendor.php */
/* Location: ./application/modules/vendor/controllers/vendor.php */