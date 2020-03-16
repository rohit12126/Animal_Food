
jQuery(document).ready(function(){

	function selectVariation(qty){
		var data = JSON.parse(jQuery('.variations_form.cart').attr("data-product_variations"));
		var option_val = '';
		//console.log(data);
		//alert(qty);
		var options = jQuery('.variations_form.cart').find('.variations select option');
		options.each(function(){
			var option_val = jQuery(this).val();
			
			if(option_val != ''){
				var val_arr = option_val.split('-to-');
				var min = parseInt((val_arr[0].replace('kg','')).trim());
				var max = parseInt((val_arr[1].replace('kg','')).trim());
				//alert(min+" "+max);
				if(qty >= min && qty <= max){
					jQuery('.variations_form.cart').find('.variations select option:selected').prop("selected", false);
					jQuery(this).prop('selected', true);
					//option_val = jQuery(this).val();
				}
				if(isNaN(min) || isNaN(max)){
					if(qty >= min || qty >= max){
						jQuery('.variations_form.cart').find('.variations select option:selected').prop("selected", false);
						jQuery(this).prop('selected', true);
					}
					//option_val = jQuery(this).val();
				}

			}
		});
		var option_val = jQuery('.variations_form.cart').find('.variations select option:selected').val();

		for(var i=0; i< data.length; i++){
			
			if(data[i].attributes.attribute_pa_weight == option_val){
				jQuery(".variations_form.cart").find(".woocommerce-variation-price .price").remove();
				jQuery(".variations_form.cart").find(".woocommerce-variation-price").append(data[i].price_html);
				jQuery(".variations_form.cart").find(".variation_id").val(data[i].variation_id);
			}
		}
	}

	function inputQTY(){
		jQuery(".variations_form.cart").find(".error span").remove();
		var _this = jQuery(".variations_form.cart").find('input[name="quantity"]');
		var select = jQuery('.variations_form.cart').find('.variations select').val();
		var val_arr = select.split('-to-');
		var min = parseInt((val_arr[0].replace('kg','')).trim());
		var max = parseInt((val_arr[1].replace('kg','')).trim());

		if(isNaN(min) || isNaN(max)){
			if(isNaN(min)){
				var maxV = max;
				var minV = max;
			}else{
				var maxV = min;
				var minV = min;
			}
		}else{
			var maxV = max;
			var minV = min;
		}
		if(jQuery(_this).val()<= '0')
			jQuery(_this).val('1');
		else if(jQuery(_this).val() > maxV){
			selectVariation(_this.val());
		}else if(jQuery(_this).val() < minV){
			//alert("select other variation.");
			jQuery(".variations_form.cart").find(".error").append('<span class="er">Please select other weight range for reduce quantity.</span>');
			jQuery(_this).val(minV);
			jQuery(_this).attr("min" , minV);
		}
		
		if(jQuery(_this).val() == parseInt(jQuery(_this).attr("max"))){
			selectVariation(jQuery(_this).attr("max"));
			jQuery(_this).val(jQuery(_this).attr("max"));
			jQuery(".variations_form.cart").find(".error").append('<span class="er">product have maximum '+jQuery(_this).attr("max")+' quantity.</span>');
			//jQuery(".variations_form.cart").find('input[name="quantity"]').attr('min' , min);
		}
		else if(jQuery(_this).val() > parseInt(jQuery(_this).attr("max"))){
			selectVariation(jQuery(_this).attr("max"));
			jQuery(_this).val(jQuery(_this).attr("max"));
			jQuery(".variations_form.cart").find(".error").append('<span class="er">product quantity exceed.</span>');
			//jQuery(".variations_form.cart").find('input[name="quantity"]').attr('min' , min);
		}
	}


	jQuery(".variations_form.cart").find('input[name="quantity"]').change(function(){
		inputQTY();
	});
	jQuery(".variations_form.cart .cart-plus-minus ").find(".dec , .inc").click(function(){
		inputQTY();
	});
	


	jQuery(".variations_form.cart").find('.variations select').change(function(ev){
		jQuery(".variations_form.cart").find(".error span").remove();
		var select = jQuery(this).val();
		var number_max = parseInt(jQuery(".variations_form.cart").find('input[name="quantity"]').attr("max"));
		var val_arr = select.split('-to-');
		var min = parseInt((val_arr[0].replace('kg','')).trim());
		var max = parseInt((val_arr[1].replace('kg','')).trim());
		
		//alert(select);
		if(select == ''){
			jQuery(".variations_form.cart").find('input[name="quantity"]').val(1);
			jQuery(".variations_form.cart").find('input[name="quantity"]').attr("min" , 1);
		}else if(isNaN(min) || isNaN(max)){
			if(isNaN(min)){
				max = max;
				min = max;
			}else{
				min = min;
				max = min;
			}
		}else{
			min = min;
			max = max;
		}

		if( max <= number_max){
			
			jQuery(".variations_form.cart").find('input[name="quantity"]').val(min);
			jQuery(".variations_form.cart").find('input[name="quantity"]').attr('min' , min);
		}else if(number_max >= min && number_max<= max){
			jQuery(".variations_form.cart").find('input[name="quantity"]').val(min);
			jQuery(".variations_form.cart").find('input[name="quantity"]').attr('min' , min);
		}else{
			jQuery(".variations_form.cart").find(".error").append('<span class="er">Product have "+number_max+" quantity.</span>');
			//alert(number_max);
			jQuery(".variations_form.cart").find('input[name="quantity"]').val(number_max);
			jQuery(".variations_form.cart").find('input[name="quantity"]').attr('min' , min);
			selectVariation(number_max);
		}
	});


	jQuery(".variations_form").submit(function(e){
		//jQuery(this).find(".error span").remove();
		var qty = jQuery(this).find('.qty').val();
		var select = jQuery(this).find('.variations select').val();
		var val_arr = select.split('-to-');
		var min = parseInt((val_arr[0].replace('kg','')).trim());
		var max = parseInt((val_arr[1].replace('kg','')).trim());
		if(qty > max){
			e.preventDefault();
			jQuery(this).find(".error").append('<span class="er">quantity is exceed to weight range. please select correct weight range.</span>');
		}
		if(jQuery(this).find(".error .er").length > 0){
			e.preventDefault();
		}

	});



	function cart_qty_field(_this){
		//var _this = jQuery(".woocommerce-cart-form").find(".quantity .cart-plus-minus-box");
		var min = parseInt(_this.attr("min"));
		var max = parseInt(_this.attr("max"));
		var qty = _this.val();
		if(qty <= 0){
			_this.val('1');
		}else if(qty > max){
			_this.val(max);
		}else if(qty < min){
			_this.val(min);
		}else
			jQuery(".woocommerce-cart-form").find('button[name="update_cart"]').prop("disabled", false);
	}

	jQuery(".woocommerce-cart-form").find(".quantity .cart-plus-minus-box").change(function(){
		cart_qty_field(jQuery(this));
	});
	jQuery(".woocommerce-cart-form .quantity").find(".dec , .inc").click(function(){
		cart_qty_field(jQuery(this).parent().find(".cart-plus-minus-box"));
	});

});