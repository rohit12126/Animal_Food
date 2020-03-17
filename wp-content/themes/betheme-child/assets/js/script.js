jQuery(document).ready(function(){

	jQuery("#add_new_weight_attribute").submit(function(e){
		e.preventDefault();
		var min = jQuery(this).find('input[name="min-weight"]').val();
		var max = jQuery(this).find('input[name="max-weight"]').val();
		if(max==''){
			var name = "up to "+min+"kg";
			var slug = "up to "+min+"kg";
		}else{
			var name = min+"kg to "+max+"kg";
			var slug = min+"kg-to-"+max+"kg";
		}
		
		jQuery.ajax({
		    type: 'POST',
		    url: my_ajax.ajax_url,
		    dataType: "json",
		    data: { action : 'add_weight_attr', 'name' : name , 'slug' : slug },
		    success: function( response ) {
		    	location.reload();
		    }
		});
	});
});