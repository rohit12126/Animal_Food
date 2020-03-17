jQuery(document).ready(function(){


	jQuery(".post-product-share-form").submit(function(e){
		e.preventDefault();
		jQuery.ajax({
		    type: 'POST',
		    url: my_ajax.ajax_url,
		    dataType: "json",
		    data: { action : 'custom_social_share', 'data' : jQuery(this).serializeArray() },
		    success: function( response ) {
		    	location.reload();
		    }
		});
	});


});