<?php
   /*
   Plugin Name: Weight Bassed Shipping
   Plugin URI: #
   description: >-
  a plugin for weight bassed shipping at zipcode.
   Version: 1.0
   Author: chapter247
   Author URI: #
   License: GPL2
   */
?>

<?php




// function work when plugin activate.
function weight_bassed_activate_plugin(){
   global $wpdb;
   $custom_table_name = $wpdb->prefix."custom_shipping_rule";

   $result = $wpdb->get_results("SELECT ID FROM ".$custom_table_name);

   if(empty($result)) {

       $query = "CREATE TABLE ".$custom_table_name." (
                 ID int(11) AUTO_INCREMENT,
                 Zone varchar(50) NOT NULL,
                 Pincode varchar(50) NOT NULL,
                 Title varchar(50) NOT NULL,
                 Cost varchar(50) NOT NULL,
                 Min varchar(50) NOT NULL,
                 Max varchar(50) NOT NULL,
                 Created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                 PRIMARY KEY  (ID)
                 )";
      $wpdb->get_results($query);
   }
}
// function work when plugin deactivate.
function weight_bassed_deactivate_plugin(){

}

// function work when plugin uninstall.
function weight_bassed_plugin_uninstall(){
   global $wpdb;
   $custom_table_name = $wpdb->prefix."custom_shipping_rule";

   $result = $wpdb->get_results("DROP TABLE IF EXISTS ".$custom_table_name);
}



register_activation_hook(__FILE__, 'weight_bassed_activate_plugin');
register_deactivation_hook( __FILE__, 'weight_bassed_deactivate_plugin' );
register_uninstall_hook( __FILE__, 'weight_bassed_plugin_uninstall' );

require_once('includes/eneque_manager.php');
require_once('includes/actions.php');
require_once('includes/shipping_rule.php');



// function is used for creating a submenu in woocommerce menu.
add_action('admin_menu', 'register_weight_based_shipping_page',99);
function register_weight_based_shipping_page() {
    add_submenu_page( 'woocommerce', 'Weight Rule', 'Weight Rule', 'manage_options', 'weight-rule', 'weight_rule_page_callback' ); 
}


// callback function for submenu.
function weight_rule_page_callback() {
    require_once('includes/weight_bassed_rule_template.php');
}



?>