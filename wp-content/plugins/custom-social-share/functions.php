<?php
   /*
   Plugin Name: Social Share
   Plugin URI: #
   description: >- a plugin for sharer.
   Version: 1.0
   Author: chapter247
   Author URI: #
   License: GPL2
   */
?>

<?php




// function work when plugin activate.
function social_share_activate_plugin(){
 
}
// function work when plugin deactivate.
function social_share_deactivate_plugin(){

}

// function work when plugin uninstall.
function social_share_plugin_uninstall(){

}



register_activation_hook(__FILE__, 'social_share_activate_plugin');
register_deactivation_hook( __FILE__, 'social_share_deactivate_plugin' );
register_uninstall_hook( __FILE__, 'social_share_plugin_uninstall' );

require_once('includes/eneque_manager.php');
require_once('includes/actions.php');



add_action('admin_menu', 'social_share_menu');
function social_share_menu(){
  add_menu_page('Social Share', 'Social Share', 'manage_options', 'social-share', 'social_share_form' );
}

function social_share_form(){
  require_once('includes/social_share_form.php');
}



?>