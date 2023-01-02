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
	
	function check_vendor_name_available(){
		$vendor_name = $this->input->get('vendor_name');
		$result = array();
		if(check_vendor_exist($vendor_name,"vendor_name")!=false){
			$result = array('error_message' => 'Vendor Name already exist..');
		}else{
			$result = array('error_message' => '');
		}
		echo json_encode($result);
	}
	function check_vendor_email_available(){
		$vendor_email = $this->input->get('vendor_email');
		$result = array();
		if(check_vendor_exist($vendor_email,"vendor_email")!=false){
			$result = array('error_message' => 'Vendor Email already exist..');
		}else{
			$result = array('error_message' => '');
		}
		echo json_encode($result);
	}
	function check_vendor_phone_available(){
		$vendor_phone = $this->input->get('vendor_phone');
		$result = array();
		if(check_vendor_exist($vendor_phone,"vendor_phone")!=false){
			$result = array('error_message' => 'Vendor Phone already exist..');
		}else{
			$result = array('error_message' => '');
		}
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
		if(check_purchase_order_exist($vendor_id)==false){
			$result = $this->vm->delete_vendor($vendor_id);
		}else{
			$result = array('error_message' => 'Purchase Order Exist..you can not delete this vendor');
		}
		echo json_encode($result);
	}
	
}

/* End of file vendor.php */
/* Location: ./application/modules/vendor/controllers/vendor.php */