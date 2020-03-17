<?php

function SSplugin_wp_admin_style_js() {
    wp_register_style( 'SS_plugin_wp_admin_css', plugins_url('/custom-social-share/assets/css/admin_style.css'), false, '1.0.0' );
    wp_enqueue_style( 'SS_plugin_wp_admin_css' );
    wp_enqueue_script( 'SS-plugin-ajax-script', plugins_url('/custom-social-share/assets/js/plugin_script.js'), array('jquery') );
    wp_localize_script( 'SS-plugin-ajax-script', 'my_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_enqueue_scripts', 'SSplugin_wp_admin_style_js' );


?>