<?php

$sharer_links = array(
"facebook" => "https://www.facebook.com/sharer/sharer.php?u=",
"google_plus" => "https://plus.google.com/share?url=",
"twitter" => "https://twitter.com/intent/tweet?original_referer=",
"linkedin" => "https://www.linkedin.com/shareArticle?mini=true&url=",
"pinterest" => "https://pinterest.com/pin/create/button/?url="
);



function custom_social_share(){
	$options = array();
	$data = $_POST["data"];
	foreach ($data as $key => $value) {
		array_push($options,$value["value"]);
	}
	$option_value = implode(",", $options);
	update_option( 'custom_social_share', $option_value, '' );
	echo json_encode(  array('status' =>  1 ) );
	die();
}
add_action('wp_ajax_custom_social_share', 'custom_social_share' ); 
add_action('wp_ajax_nopriv_custom_social_share', 'custom_social_share' ); 



add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart_button_func' );
function add_content_after_addtocart_button_func() {
	global $product;
	
	$options = get_option( 'custom_social_share' );
	
	if(!empty($options)){
		echo '<div class="social-icon mt-30">'.social_ul($options , get_permalink( $product->id )).'</div>';
	}
}

function social_ul($options , $page_url){
	global $sharer_links;
	$share_item = array();
	$html = '';
	
	$options = explode(",", $options);
	foreach ($options as $key => $value) {
		$share_item[$value] = $sharer_links[$value];
	}

	$html = '<ul>';
	if(!empty($share_item["facebook"]))
		$html .= '<li><a href="'.$share_item["facebook"].''.$page_url.'" target=”_blank”><i class="icon-social-facebook"></i></a></li>';
	if(!empty($share_item["twitter"]))
		$html .= '<li><a href="'.$share_item["twitter"].''.$page_url.'" target=”_blank”><i class="icon-social-twitter"></i></a></li>';
	if(!empty($share_item["linkedin"]))
		$html .= '<li><a href="'.$share_item["linkedin"].''.$page_url.'" target=”_blank”><i class="icon-social-linkedin"></i></a></li>';
	if(!empty($share_item["google_plus"]))
		$html .= '<li><a href="'.$share_item["google_plus"].''.$page_url.'" target=”_blank”><i class="icon-social-google"></i></a></li>';
	if(!empty($share_item["pinterest"]))
		$html .= '<li><a href="'.$share_item["pinterest"].''.$page_url.'" target=”_blank”><i class="icon-social-pinterest"></i></a></li>';
	$html .= '</ul>';

	return $html;
}

?>