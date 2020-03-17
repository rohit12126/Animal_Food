<?php
// shipping method file

add_action('woocommerce_shipping_init', 'weight_bassed_shipping_methode');
function weight_bassed_shipping_methode() {

    if ( ! class_exists( 'WC_Weight_bassed_Shipping_Method' ) ) {
        class WC_Weight_bassed_Shipping_Method extends WC_Shipping_Method {

            public function __construct( $instance_id = 0) {
                $this->id = 'weight_bassed_shipping';
                $this->instance_id = absint( $instance_id );
                $this->domain = 'rasq';
                $this->method_title = __( 'Weight Bassed Shipping', $this->domain );
                $this->method_description = __( 'Shipping method to be used for add charges according to weight.', $this->domain );
                $this->supports = array(
                    'shipping-zones',
                    'instance-settings',
                    'instance-settings-modal',
                );
                $this->init();
            }

            ## Load the settings API
            function init() {
                $this->init_form_fields();
                $this->init_settings();
                $this->enabled = $this->get_option( 'enabled', $this->domain );
                $this->title   = $this->get_option( 'title', $this->domain );
                $this->info    = $this->get_option( 'info', $this->domain );
                add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
             }

            function init_form_fields() {
                $this->instance_form_fields = array(
                    'title' => array(
                        'type'          => 'text',
                        'title'         => __('Title', $this->domain),
                        'description'   => __( 'Title to be displayed on site.', $this->domain ),
                        'default'       => __( 'Weight Bassed Shipping', $this->domain ),
                    ),
                    
                );
            }



            public function get_shipping_charge($pincode){

                $cart_weigth = 0;
            
                foreach(WC()->cart->get_cart() as $cart_item) { 
                    $product = $cart_item['data'];
                    $qty     = $cart_item['quantity'];
                    $pro_weight = $product->get_weight();
                    if(empty($pro_weight) || $pro_weight == 0){
                    	$pro_weight = 1;
                    }
            
                  
                    $cart_weigth += $qty * $pro_weight;
                } 
                //return $cart_weigth;

                global $wpdb;
                $custom_table_name = $wpdb->prefix."custom_shipping_rule";
                $result = $wpdb->get_results("SELECT Cost FROM ".$custom_table_name." WHERE `Min` <= ".$cart_weigth." AND `Max` >= ".$cart_weigth." AND `Pincode` = ".$pincode."");
                $rate = $result[0]->Cost;



                return $rate;
            }
            
            

            public function calculate_shipping( $packages = array() ) {
            	$rate_charge = $this->get_shipping_charge($packages["destination"]["postcode"]);

            	if(empty($rate_charge)){
					$this->add_rate( false );
            	}else{
	            	//$rate_charge = $total_weigth * 10;
	                $rate = array(
	                    'id'       => $this->id,
	                    'label'    => $this->title,
	                    'cost'     => $rate_charge,
	                    'calc_tax' => 'per_item'
	                );
	                $this->add_rate( $rate );
	            }
            }
        }
    }
}

add_filter('woocommerce_shipping_methods', 'add_request_shipping_quote');
function add_request_shipping_quote( $methods ) {
    $methods['weight_bassed_shipping'] = 'WC_Weight_bassed_Shipping_Method';
    return $methods;
}


?>