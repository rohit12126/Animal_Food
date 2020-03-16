<?php
global $wpdb;

//SELECT * FROM `wp_woocommerce_attribute_taxonomies`
$data = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."term_taxonomy` WHERE `taxonomy` LIKE 'pa_weight'");
$list = '';

foreach ($data as $key => $value) {
	$result = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."terms` WHERE `term_id` = '".$value->term_id."'");
	$list .= '<tr><th class="check-column"><input type="checkbox" name="ids[]" value="'.$result[0]->name.'"></th><td>'.$result[0]->name.'</td></tr>';
}


?>

<h3>Weight Attribute</h3>
<div id="col-left" class="add_rule_form_container">
	<div class="col-wrap">
		<div class="form-wrap">
			<h2>Add New Attribute</h2>
			<form id="add_new_weight_attribute" method="post" action="" class="validate">	
				<div class="form-field">
					<div class="half-field">
						<label for="min-weight">Min Weight</label>
						<input name="min-weight" type="number" min="1" required="">		
					</div>
					<div class="half-field">
						<label for="max-weight">Max Weight</label>
						<input name="max-weight" type="number" min="2">
					</div>
				</div>					
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Add New Attribute"><span class="spinner"></span>
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
			<th scope="col">Weight Attributes</th>
		</tr>
		</thead>

		<tbody id="the-list">
			<?php echo $list; ?>
		</tbody>
	</table>
</div>





