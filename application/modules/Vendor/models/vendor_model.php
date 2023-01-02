<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

    private $vendor = 'vendor';
	
	//input values	
	public function input_values()
    {
        $data = array(
			'vendor_name' => $this->input->post('vendor_name', true),
			'vendor_phone' => $this->input->post('vendor_phone', true),
			'vendor_email' => $this->input->post('vendor_email', true),
			'vendor_address' => $this->input->post('vendor_address', true)
        );
        return $data;
    }

	function vendor_list(){
        $data = $this->db->get($this->vendor);
        return $data->result();
    }
	
	function get_vendor_by_id($vendor_id){
		$data = $this->db->get_where($this->vendor, array('vendor_id' => $vendor_id))->row();
		
		$result=array(
			'vendor_id' => $data->vendor_id,
			'vendor_name' => $data->vendor_name,
			'vendor_phone' => $data->vendor_phone,
			'vendor_email' => $data->vendor_email,
			'vendor_address' => $data->vendor_address,
		);
		return $result;
	}
	
	function check_vendor_exist($vendor,$input_field){
		$result = $this->db->get_where($this->vendor, array($input_field => $vendor))->result();
		
		if (!empty($result)) {
			foreach ($result as $value) {
				$data=array(
					'vendor_id' => $value->vendor_id,
					'vendor_name' => $value->vendor_name,
					'vendor_phone' => $value->vendor_phone,
					'vendor_email' => $value->vendor_email,
					'vendor_address' => $value->vendor_address,
				);
			}
			return $data;
		} else {
			return false;
		}
	}
 
    function add_vendor($data){
		return $this->db->insert($this->vendor, $data);
    }
 
    function update_vendor($data){
        $this->db->set('vendor_name', $data['vendor_name']);
        $this->db->set('vendor_phone', $data['vendor_phone']);
        $this->db->set('vendor_email', $data['vendor_email']);
        $this->db->set('vendor_address', $data['vendor_address']);
        $this->db->where('vendor_id', $data['vendor_id']);
        return $this->db->update($this->vendor);
    }
 
    function delete_vendor($vendor_id){
		$this->db->where('vendor_id', $vendor_id);
		return $this->db->delete($this->vendor);
    }
	
	
	function get_vendors($postData=null){

		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		## Search 
		$searchQuery = "";
		if($searchValue != ''){
		  $searchQuery = " (`vendor_name` like '%".$searchValue."%' or 
				`vendor_email` like '%".$searchValue."%' or 
				`vendor_phone` like'%".$searchValue."%' ) ";
		}


		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$records = $this->db->get($this->vendor)->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(*) as allcount');
		if($searchQuery != ''){
			$this->db->where($searchQuery);
		}
		$records = $this->db->get($this->vendor)->result();
		$totalRecordwithFilter = $records[0]->allcount;


		## Fetch records
		$this->db->select('*');
		if($searchQuery != ''){
			$this->db->where($searchQuery);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get($this->vendor)->result();

		$data = array();
		foreach($records as $record ){
		  $data[] = array( 
			  "vendor_id"=>$record->vendor_id,
			  "vendor_name"=>$record->vendor_name,
			  "vendor_phone"=>$record->vendor_phone,
			  "vendor_email"=>$record->vendor_email,
			  "vendor_address"=>$record->vendor_address,
			  "operation"=>'<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'.$record->vendor_id.'">Edit</a>
                           <a href="javascript:;" class="btn btn-danger btn-xs item_delete" data="'.$record->vendor_id.'">Delete</a>'
		  );
		}

		## Response
		$response = array(
		  "draw" => intval($draw),
		  "iTotalRecords" => $totalRecords,
		  "iTotalDisplayRecords" => $totalRecordwithFilter,
		  "aaData" => $data
		);

		return $response; 
	}
}

/* End of file vendorModel.php */
/* Location: ./application/modules/vendor/models/vendorModel.php */
