<?php

function get_pincode_by_zone() {
	global $wpdb;
	$zone_id = $_POST["id"];
	$data = $wpdb->get_results( "SELECT location_code FROM `".$wpdb->prefix."woocommerce_shipping_zone_locations` WHERE `zone_id` = '".$zone_id."' AND `location_type` = 'postcode'");
	/*echo "<pre>";
	print_r($data);*/
	$pincode_options = '<option value="-1">Select Pincode</option>';
	foreach ($data as $key => $value) {
		$pincode_options .= '<option value="'.$value->location_code.'">'.$value->location_code.'</option>';		
	}
	echo json_encode(  array('option' =>  $pincode_options ) );
	die();
}
add_action('wp_ajax_get_pincode_by_zone', 'get_pincode_by_zone' ); 
add_action('wp_ajax_nopriv_get_pincode_by_zone', 'get_pincode_by_zone' ); 



function add_new_shipping_rule(){
	
	$zone = get_zone_name($_POST["data"][1]["value"]);
	$pincode = $_POST["data"][2]["value"];
	$title = $_POST["data"][0]["value"];
	$cost = $_POST["data"][3]["value"];
	$min = $_POST["data"][4]["value"];
	$max = $_POST["data"][5]["value"];

	global $wpdb;
	$data = $wpdb->get_results( "INSERT INTO `".$wpdb->prefix."custom_shipping_rule`(`Zone`, `Pincode`, `Title`, `Cost`, `Min`, `Max`) VALUES ('".$zone."' , '".$pincode."' , '".$title."' , '".$cost."' , '".$min."' , '".$max."')" );

	echo json_encode(  array('status' =>  "1" ) );
	die();
}
add_action('wp_ajax_add_new_shipping_rule', 'add_new_shipping_rule' ); 
add_action('wp_ajax_nopriv_add_new_shipping_rule', 'add_new_shipping_rule' ); 



function delete_shipping_rule(){
	//echo "<pre>";	
	$ids = $_POST["data"];
	for ($i=0; $i < count($ids); $i++) { 
		$condition .= "`ID` = ".$ids[$i];
		if($i != count($ids)-1){
			$condition .= " OR ";
		}
	}

	global $wpdb;
	$result = $wpdb->get_results( "DELETE FROM `".$wpdb->prefix."custom_shipping_rule` WHERE ".$condition);
	echo json_encode(  array('status' =>  "1" ) );
	die();
}
add_action('wp_ajax_delete_shipping_rule', 'delete_shipping_rule' ); 
add_action('wp_ajax_nopriv_delete_shipping_rule', 'delete_shipping_rule' ); 




function get_zone_name($zone_id){
	
	global $wpdb;
	$zone_name = $wpdb->get_results( "SELECT zone_name FROM `".$wpdb->prefix."woocommerce_shipping_zones` WHERE `zone_id` = '".$zone_id."'");
	return $zone_name[0]->zone_name;
}






?>