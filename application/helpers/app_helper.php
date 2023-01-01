<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

//Check if purchase order exist by vendor id
if(!function_exists('check_purchase_order_exist')){
    function check_purchase_order_exist($vendor_id)
    {
        $data = array();
        $ci = &get_instance();
		$data = $ci->pom->get_purchase_order_by_vendor_id($vendor_id);

        return $data;
    }
}