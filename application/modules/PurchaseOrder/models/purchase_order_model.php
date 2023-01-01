<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Purchase_order_model extends CI_Model {

    private $po = 'purchase_order';
	
	//input values	
	public function input_values()
    {
        $data = array(
			'purchase_order_id' => $this->input->post('purchase_order_id', true),
			'vendor_id' => $this->input->post('vendor_id', true),
			'item_name' => $this->input->post('item_name', true),
			'item_quantity' => $this->input->post('item_quantity', true),
			'unit_price' => $this->input->post('unit_price', true),
			'total_price' => $this->input->post('total_price', true)
        );
        return $data;
    }

	function purchase_order_list(){
        $purchase_order=$this->db->get($this->po);
        return $purchase_order->result();
    }
	
	function get_purchase_order_by_id($purchase_order_id){
		$data = $this->db
					 ->select('po.*,v.*')
					 ->from('purchase_order po')
					 ->join('vendor v', 'v.vendor_id = po.vendor_id')
					 ->where('purchase_order_id', $purchase_order_id)
					 ->get()
					 ->row();
		
		$result=array(
			'purchase_order_id' => $data->purchase_order_id,
			'vendor_id' => $data->vendor_id,
			'item_name' => $data->item_name,
			'item_quantity' => $data->item_quantity,
			'unit_price' => $data->unit_price,
			'total_price' => $data->total_price,
		);
		return $result;
	}
	
	function get_purchase_order_by_vendor_id($vendor_id){
		$data = $this->db
					 ->select('po.*,v.*')
					 ->from('purchase_order po')
					 ->join('vendor v', 'v.vendor_id = po.vendor_id')
					 ->where('v.vendor_id', $vendor_id)
					 ->get()->result();
					 
		$result = array();
		foreach($data as $row){
			$result = array(
						'purchase_order_id' => $row->purchase_order_id,
						'item_name' => $row->item_name,
						'item_quantity' => $row->item_quantity,
						'unit_price' => $row->unit_price,
						'total_price' => $row->total_price,
					);
		}
		//$str = $this->db->last_query(); echo $str;exit;
		//if($data->num_rows>0){
		//	return true;
		//}
		//$result=array(
		//	'purchase_order_id' => $data->purchase_order_id,
		//	'vendor_id' => $data->vendor_id,
		//	'item_name' => $data->item_name,
		//	'item_quantity' => $data->item_quantity,
		//	'unit_price' => $data->unit_price,
		//	'total_price' => $data->total_price,
		//);
		return $result;
	}
 
    function add_purchase_order($data){
		return $this->db->insert($this->po, $data);
    }
 
    function update_purchase_order($data){
        $this->db->set('vendor_id', $data['vendor_id']);
        $this->db->set('item_name', $data['item_name']);
        $this->db->set('item_quantity', $data['item_quantity']);
        $this->db->set('unit_price', $data['unit_price']);
        $this->db->set('total_price', $data['total_price']);
        $this->db->where('purchase_order_id', $data['purchase_order_id']);
        return $this->db->update($this->po);
    }
 
    function delete_purchase_order(){
        $purchase_order_id = $this->input->post('purchase_order_id');
        $this->db->where('purchase_order_id', $purchase_order_id);
        return $this->db->delete($this->po);
    }
	
	function get_purchase_orders($postData=null){

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
		  $searchQuery = " (po.`item_name` like '%".$searchValue."%' or 
				po.`vendor_name` like '%".$searchValue."%') ";
		}


		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$records = $this->db->get($this->po)->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(*) as allcount');
		if($searchQuery != ''){
			$this->db->where($searchQuery);
		}
		$records = $this->db->get($this->po)->result();
		$totalRecordwithFilter = $records[0]->allcount;

		
		## Fetch records
		$this->db->select('po.*,v.*'); 
		$this->db->join('vendor v', 'v.vendor_id = po.vendor_id'); 
		if($searchQuery != ''){
			$this->db->where($searchQuery);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get('purchase_order po')->result();
		//$str = $this->db->last_query(); echo $str;exit;
		
		$data = array();
		foreach($records as $record ){
		  $data[] = array( 
			  "purchase_order_id"=>$record->purchase_order_id,
			  "vendor_name"=>$record->vendor_name,
			  "item_name"=>$record->item_name,
			  "item_quantity"=>$record->item_quantity,
			  "unit_price"=>$record->unit_price,
			  "total_price"=>$record->total_price,
			  "operation"=>'<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'.$record->purchase_order_id.'">Edit</a>
                           <a href="javascript:;" class="btn btn-danger btn-xs item_delete" data="'.$record->purchase_order_id.'">Delete</a>'
		  );
		}

		## Response
		$response = array(
		  "draw" => intval($draw),
		  "iTotalRecords" => $totalRecords,
		  "iTotalDisplayRecords" => $totalRecordwithFilter,
		  "aaData" => $data
		);
		
		//print_r($response);exit;

		return $response; 
	}
}

/* End of file purchase_order_model.php */
/* Location: ./application/modules/purchase_order/models/purchase_order_model.php */
