jQuery(document).ready(function(){
	jQuery("#add_new_rule").find('select[name="zone"]').change(function(){
		var zoneid = jQuery(this).val();
		if(jQuery(this).val() > 0){
			jQuery.ajax({
			    type: 'POST',
			    url: my_ajax.ajax_url,
			    dataType: "json",
			    data: { action : 'get_pincode_by_zone', id : zoneid },
			    success: function( response ) {
			    	jQuery("#add_new_rule").find('select[name="pincode"] option').remove();
			        jQuery("#add_new_rule").find('select[name="pincode"]').append(response.option);
			    }
			});
		}else{
			 jQuery("#add_new_rule").find('select[name="pincode"] option').remove();
			 jQuery("#add_new_rule").find('select[name="pincode"]').append('<option disabled="">Select Zone First</option>');
		}
	});
	
	
	jQuery("#add_new_rule").find('input[name="min-weight"]').change(function(){
		var min = parseInt(jQuery(this).val());
	    jQuery("#add_new_rule").find('input[name="max-weight"]').attr("min" , min+1);
	});


	jQuery("#add_new_rule").submit(function(e){
		e.preventDefault();
		jQuery("#add_new_rule").find(".invalid").removeClass("invalid");
		var checked = 1;
		if((jQuery(this).find('input[name="title"]').val()).trim() == ''){
			checked = 0;
			jQuery(this).find('input[name="title"]').parents(".half-field").addClass("invalid");
		}
		
		if(jQuery(this).find('select[name="zone"]').val() < 0){
			checked = 0;
			jQuery(this).find('select[name="zone"]').parents(".half-field").addClass("invalid");
		}

		if(jQuery(this).find('select[name="pincode"]').val() == "null" || jQuery(this).find('select[name="pincode"]').val() == "-1"){
			checked = 0;
			jQuery(this).find('select[name="pincode"]').parents(".half-field").addClass("invalid");
		}

		if(jQuery(this).find('input[name="cost-per-kg"]').val() == ""){
			checked = 0;
			jQuery(this).find('input[name="cost-per-kg"]').parents(".half-field").addClass("invalid");
		}

		if(jQuery(this).find('input[name="min-weight"]').val() == ""){
			checked = 0;
			jQuery(this).find('input[name="min-weight"]').parents(".half-field").addClass("invalid");
		}

		if(jQuery(this).find('input[name="max-weight"]').val() == ""){
			checked = 0;
			jQuery(this).find('input[name="max-weight"]').parents(".half-field").addClass("invalid");
		}

		if(checked > 0){
			jQuery.ajax({
			    type: 'POST',
			    url: my_ajax.ajax_url,
			    dataType: "json",
			    data: { action : 'add_new_shipping_rule', data : jQuery(this).serializeArray() },
			    success: function( response ) {
			    	location.reload();
			    }
			});
		}

	});

	jQuery(".weight_rules_action_nav").find("#delete").click(function(e){
		e.preventDefault();
		var ids = [];

		jQuery(".weight_based_rule_list").find('#the-list input[type="checkbox"]').each(function(){
			if(jQuery(this).prop('checked') == true){
				ids.push(jQuery(this).val());
			}
		});

		if(ids.length === 0){
			alert("select rule");
		}else{
			jQuery.ajax({
			    type: 'POST',
			    url: my_ajax.ajax_url,
			    dataType: "json",
			    data: { action : 'delete_shipping_rule', data : ids },
			    success: function( response ) {
			    	location.reload();
			    }
			});
		}
	});
});