<?php

function plugin_wp_admin_style_js() {
    wp_register_style( 'WBS_plugin_wp_admin_css', plugins_url('/weight-bassed-shipping/assets/css/admin_style.css'), false, '1.0.0' );
    wp_enqueue_style( 'WBS_plugin_wp_admin_css' );
    wp_enqueue_script( 'WBS-plugin-ajax-script', plugins_url('/weight-bassed-shipping/assets/js/plugin_script.js'), array('jquery') );
    wp_localize_script( 'plugin-ajax-script', 'my_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_enqueue_scripts', 'plugin_wp_admin_style_js' );


?>