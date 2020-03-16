<?php
global $wpdb;
$zone_ids = $wpdb->get_results( "SELECT zone_id FROM `".$wpdb->prefix."woocommerce_shipping_zone_methods` WHERE `method_id` = 'weight_bassed_shipping'");

$condition = '';
for ($i=0; $i < count($zone_ids); $i++) { 
	$condition .= "`zone_id` = ".$zone_ids[$i]->zone_id;
	if($i != count($zone_ids)-1){
		$condition .= " OR ";
	}
}

$zone_data = $wpdb->get_results( "SELECT zone_id , zone_name FROM `".$wpdb->prefix."woocommerce_shipping_zones` WHERE ".$condition);

$zone_option = '<option value="-1">Select Zone</option>';
foreach ($zone_data as $key => $value) {
	$zone_option .= '<option value="'.$value->zone_id.'">'.$value->zone_name.'</option>';
}



/* =========== list fetch ============ */

$rule_data = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."custom_shipping_rule` ORDER BY `wp_custom_shipping_rule`.`Zone` ASC");

$rule_list = '';
if(!empty($rule_data)){
	foreach ($rule_data as $key => $value) {
		$rule_list .= '<tr id="'.$value->ID.'" class="rule_item">
			<th class="check-column">
				<input type="checkbox" name="ids[]" value="'.$value->ID.'">
			</th>
			<td><span>'.$value->Zone.'</span></td>
			<td><span>'.$value->Pincode.'</span></td>
			<td><span>'.$value->Title.'</span></td>
			<td><span>'.$value->Min.' kg </span></td>
			<td><span>'.$value->Max.' kg </span></td>
			<td><span>'.$value->Cost.' Rs. </span></td>
		</tr>';
	}
}else{
	$rule_list = '<tr class="no_data"><td></td><td>no rule found.</td><td></td><td></td><td></td><td></td></tr>';
}


?>

<h3>Weight Based Rule</h3>
<div id="col-left" class="add_rule_form_container">
	<div class="col-wrap">
		<div class="form-wrap">
			<h2>Add New Rule</h2>
			<form id="add_new_rule" method="post" action="" class="validate">	
				<div class="form-field">
					<div class="half-field">
						<label for="title">Title</label>
						<input name="title" type="text" size="40" aria-required="true">
					</div>
					<div class="half-field">
						<label for="zone">Zone</label>
						<select name="zone">
							<?php echo $zone_option; ?>
						</select>
					</div>
				</div>
				<div class="form-field">
					<div class="half-field">
						<label for="pincode">PinCode</label>
						<select name="pincode">
							<option disabled="">Select Zone First</option>
						</select>
					</div>
					<div class="half-field">
						<label for="cost-per-kg">Cost per kg</label>
						<input name="cost-per-kg" type="number" min="1">
					</div>
				</div>	
				<div class="form-field">
					<div class="half-field">
						<label for="min-weight">Min Weight</label>
						<input name="min-weight" type="number" min="1">
					</div>
					<div class="half-field">
						<label for="max-weight">Max Weight</label>
						<input name="max-weight" type="number" min="2">
					</div>
				</div>					
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Add New Rule"><span class="spinner"></span>
				</p>
			</form>
		</div>
	</div>
</div>


<div class="rule_list_container" id="col-right">
	<div class="tablenav top weight_rules_action_nav">
		<div class="alignleft">
			<input type="button" id="delete" class="button" value="Delete Selected">
		</div>	
	</div>

	<table class="wp-list-table widefat striped weight_based_rule_list">
		<thead>
		<tr>
			<td id="cb" class="manage-column column-cb check-column">
				<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
				<input id="cb-select-all-1" type="checkbox">
			</td>
			<th scope="col">Zone</th>
			<th scope="col">Pincode</th>
			<th scope="col">Title</th>
			<th scope="col">Min Weight</th>
			<th scope="col">Max Weight</th>
			<th scope="col">Cost Per kg</th>
		</tr>
		</thead>

		<tbody id="the-list">
			<?php echo $rule_list; ?>
		</tbody>
	</table>
</div>





