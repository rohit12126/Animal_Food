<?php

add_action( 'wp_enqueue_scripts', 'enqueue_betheme_child' );
function enqueue_betheme_child() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style( 'custom-icons-style', get_stylesheet_directory_uri() . '/assets/css/custom-icons.css');
    wp_enqueue_style( 'simple-line-icons-style', get_stylesheet_directory_uri() . '/assets/css/simple-line-icons.css');
    wp_enqueue_style( 'pacifico-font', 'https://fonts.googleapis.com/css?family=Pacifico&display=swap');

    wp_enqueue_script('my-custom-js', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ), '1.0', true );
	//wp_enqueue_script('betheme-child-js', './betheme-child/js/script.js', array( 'jquery' ), '1.0', true );simple-line-icons.css

    /* ------------------ html template css --------------------- */
    wp_enqueue_style( 'animate-css', get_stylesheet_directory_uri() . '/assets/css/animate.css');
    wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style( 'jquery-ui-css', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.css');
    wp_enqueue_style( 'meanmenu-min-css', get_stylesheet_directory_uri() . '/assets/css/meanmenu.min.css');
    wp_enqueue_style( 'owl-carousel-min-css', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style( 'responsive-css', get_stylesheet_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css');
    wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style( 'themify-icons-css', get_stylesheet_directory_uri() . '/assets/css/themify-icons.css');



    /* ------------------ html template js --------------------- */

    
    
    wp_enqueue_script('instafeed-js', get_stylesheet_directory_uri() . '/assets/js/instafeed.js', array( 'jquery' ), '1.0', true );
    
    wp_enqueue_script('jquery-1.12.0.min-js', get_stylesheet_directory_uri() . '/assets/js/vendor/jquery-1.12.0.min.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script('modernizr-2.8.3.min-js', get_stylesheet_directory_uri() . '/assets/js/vendor/modernizr-2.8.3.min.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script('popper-js', get_stylesheet_directory_uri() . '/assets/js/popper.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('jquery-counterup-min-js', get_stylesheet_directory_uri() . '/assets/js/jquery.counterup.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('waypoints-min-js', get_stylesheet_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('elevetezoom-js', get_stylesheet_directory_uri() . '/assets/js/elevetezoom.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('ajax-mail-js', get_stylesheet_directory_uri() . '/assets/js/ajax-mail.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('owl-carousel-min-js', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('plugins-js', get_stylesheet_directory_uri() . '/assets/js/plugins.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script('main-js-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );

	
}


/* ======================= admin css and js ========================== */

function load_custom_wp_admin_style() {
    wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/assets/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
    wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery') );
    wp_localize_script( 'ajax-script', 'my_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );









// [Product_Category count="3"]
function product_categories_card( $atts ) {
	$a = shortcode_atts( array('count' => ''), $atts );
	/*$count = $a['count'];
	$html = '<a href="#"></a>';
	return $html;*/
	$categories = get_categories(array('taxonomy'     => 'product_cat' , 'order'      => 'ASC',));
	$html = '<div class="food-category food-category-col pt-100 pb-60"><div class="container"><div class="row">';
	foreach ($categories as $key => $value) {
		$cat_link = get_category_link( $value->term_id );
		$thumbnail_id = get_woocommerce_term_meta( $value->term_id, 'thumbnail_id', true ); 
	    $image = wp_get_attachment_url( $thumbnail_id ); 
	
		if($value->term_id != 15){
			$html .= '<div class="col-lg-4 col-md-4">
						<a href="'.$cat_link.'">
							<div class="single-food-category cate-padding-1 text-center mb-30">
							    <div class="single-food-hover-2">
							        <img src="'.$image.'" alt="">
							    </div>
							    <div class="single-food-content">
							        <h3>'.$value->name.'</h3>
							    </div>
							</div>
						</a>
					</div>';
		}
	}
	$html .= '</div></div></div>';
	return $html;
}
add_shortcode( 'Product_Category', 'product_categories_card' );



// [recent_product per_page="3"]
function recent_product_card($atts){
	$a = shortcode_atts( array('per_page' => ''), $atts );
	$per_page = $a['per_page'];
	if(empty($per_page))
		$per_page = 4;
	$args = array(
	'post_type' => 'product',
	'posts_per_page' => $per_page,
	'orderby' =>'date',
	'order' => 'DESC' );

	$loop = new WP_Query( $args );
	$html = '<div class="row">';
	while ( $loop->have_posts() ) : $loop->the_post();
		global $product;
		//the_permalink();
		if (has_post_thumbnail( $loop->post->ID ))
			$image = get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
		else
			$image = '<img src="'.woocommerce_placeholder_img_src().'" alt="My Image Placeholder" />';
		
		if( $product->is_type( 'simple' ) )
			$actions = '<a title="Quick View" data-toggle="modal" data-target="" href="'.get_permalink( $product->ID ).'"><i class="ti-plus"></i></a>
				<a title="Add To Cart" href="?add-to-cart='.get_the_ID().'" data-quantity="1" data-product_id="'.get_the_ID().'" class="add_to_cart_button ajax_add_to_cart product_type_simple"><i class="ti-shopping-cart"></i></a>';
		else
			$actions = '<a title="Quick View" data-toggle="modal" data-target="" href="'.get_permalink( $product->ID ).'"><i class="ti-plus"></i></a>';

	
		$html .= '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
				        <div class="product-wrapper mb-10">
				            <div class="product-img">
				                <a href="'.get_permalink( $product->ID ).'">
				                    '.$image.'
				                </a>
				                <div class="product-action">
				                    '.$actions.'
				                </div>
				                <div class="product-action-wishlist">
				                    '.do_shortcode("[yith_wcwl_add_to_wishlist]").'
				                </div>
				            </div>
				            <div class="product-content">
				                <h4><a href="'.get_permalink( $product->ID ).'">'.get_the_title( $product->ID ).'</a></h4>
				                <div class="product-price">
				                    '.$product->get_price_html().'
				                </div>
				            </div>
				        </div>
				    </div>';

	endwhile;
	wp_reset_query(); 

	$html .= '</div>';

	return $html;
}
add_shortcode( 'recent_product', 'recent_product_card' );



// [latest_blog per_page="3"]
function latest_blog_card($atts){

	$html = '<div class="row">';

	$args = array(
	'post_type' => 'blog',
	'posts_per_page' => 3,
	'orderby' =>'date',
	'order' => 'DESC' );

	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		if (has_post_thumbnail( $loop->post->ID ))
				$image = get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
			else
				$image = '<img src="'.woocommerce_placeholder_img_src().'" alt="My Image Placeholder" />';

		$author = get_the_author($loop->post->ID);
		$title = get_the_title( $loop->post->ID );

		$html .= '<div class="col-lg-4 col-md-6">
        <div class="blog-wrapper mb-30 gray-bg">
            <div class="blog-img hover-effect">
                <a href="'.get_permalink($loop->post->ID).'">'.$image.'</a>
            </div>
            <div class="blog-content">
                <div class="blog-meta">
                    <ul>
                        <li>By: <span>'.$author.'</span></li>
                        <li>'.get_the_date( 'M d,Y' ).'</li>
                    </ul>
                </div>
                <h4><a href="'.get_permalink($loop->post->ID).'">'.$title.'</a></h4>
            </div>
        </div>
    </div>';

	endwhile;
	wp_reset_query(); 

	$html .= '</div>';

	return $html;

}
add_shortcode( 'latest_blog', 'latest_blog_card' );



/* ============================ home slider ================================== */

//[home_slider per_page="3"]
function home_slider_func(){

	$html = '<div class="slider-area">
    <div class="slider-active owl-dot-style owl-carousel">';


	$args = array(
	'post_type' => 'slide',
	'posts_per_page' => 3,
	'orderby' =>'date',
	'order' => 'DESC' );

	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$cursive_head = '';
		if (!empty(get_field( 'cursive_heading', $loop->post->ID))) {
			$cursive_head = '<h3 class="animated">'.get_field( 'cursive_heading', $loop->post->ID).'</h3>';
		}

		$button_link = 'javascript:void(0)';
		if(!empty(get_field( 'button_url', $loop->post->ID))){
			$button_link = get_field( 'button_url', $loop->post->ID);
		}

		$html .= '<div class="single-slider pt-50 pb-50 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 col-sm-7">
                <div class="slider-content slider-animated-1 pt-114">
                    '.$cursive_head.'
                    <h1 class="animated">'.get_field( 'big_heading', $loop->post->ID).'</h1>
                    <div class="slider-btn">
                        <a class="animated" href="'.$button_link.'">'.get_field( 'button_name', $loop->post->ID).'</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 col-sm-5">
                <div class="slider-single-img slider-animated-1">
                    <img class="animated" src="'.get_field( 'image', $loop->post->ID).'" alt="">
                </div>
            </div>
        </div>
    </div>
</div>';


	endwhile;
	wp_reset_query();

	$html .= '</div></div>';

	return $html;
}

add_shortcode( 'home_slider', 'home_slider_func' );




/* ================================== custom testimonial view ======================================== */
//[testimonial_slide_view]
function testimonial_custom_slide_view(){
	$args = array(
	'post_type' => 'wpm-testimonial',
	'posts_per_page' => -1,
	'orderby' =>'date',
	'order' => 'DESC' );

	$loop = new WP_Query( $args );
	$contentList = '';
	$imageList = '';
	while ( $loop->have_posts() ) : $loop->the_post();
		if (has_post_thumbnail( $loop->post->ID ))
				$image = get_the_post_thumbnail($loop->post->ID);
			else
				$image = '<img src="'.get_stylesheet_directory_uri().'/assets/img/testi/5.jpg" alt="My Image Placeholder" />';

		$contentList .= '<div class="sin-testiText">
							<p>'.get_the_excerpt( $loop->post->ID ).'</p>
						</div>';
		$imageList .= '<div class="sin-testiImage">
						'.$image.'
						<h3>'.get_the_title( $loop->post->ID ).'</h3>
					</div>';

	endwhile;
	wp_reset_query();

	return '<div class="testimonial-area pt-90 pb-70 bg-img">
			    <div class="container">
	                <div class="row">
	                    <div class="col-lg-10 ml-auto mr-auto">
	                        <div class="testimonial-wrap">
	                            <div class="testimonial-text-slider text-center">
	                                '.$contentList.'
	                            </div>
	                            <div class="testimonial-image-slider text-center">
	                                '.$imageList.'
	                            </div>
	                            <div class="testimonial-shap">
	                                <img src="'.get_stylesheet_directory_uri().'/assets/img/icon-img/testi-shap.png" alt="">
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div>';

}
add_shortcode( 'testimonial_slide_view', 'testimonial_custom_slide_view' );



















add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'blog',
        array(
            'labels' => array(
                'name' => __( 'Blog' ),
                'singular_name' => __( 'Blog' )
            ),
        'show_ui' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail','comments' ),
        'public' => true,
        'has_archive' => true,
        )
    );
}
add_action( 'init', 'create_jobstax', 0 );
function create_jobstax() {
    register_taxonomy(
    'blog_category',
    'blog',
	array(
	'labels' => array(
	    'name' => __( 'Category' ),
	    'singular_name' => __( 'Category' )
	),

            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true          
        )
    );  
}

function show_regularsale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {
	$product = $cart_item['data'];
	if ( $product ) {
		return $product->get_price_html();
	}
	return $old_display;
	 }
add_filter( 'woocommerce_cart_item_price', 'show_regularsale_price_at_cart', 10, 3 );





if ( is_admin() ) {
    add_action( 'admin_menu', 'register_weight_attribute_page', 100 );
}

function register_weight_attribute_page() {

    add_submenu_page('edit.php?post_type=product',__( 'Weight Attribute' ),__( 'Weight Attribute' ),'manage_woocommerce','weight-attribute','weight_attribute_page_callback');
}

function weight_attribute_page_callback() {
    require_once('woocommerce/weight_attribute/attribute.php');
}

function add_weight_attr(){
	$name = $_POST["name"];
	$slug = $_POST["slug"];

	global $wpdb;
//
	$wpdb->get_results( "INSERT INTO `".$wpdb->prefix."terms`(`name`, `slug`, `term_group`) VALUES ('".$name."','".$slug."','0')");
	$data = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."terms` WHERE `name` = '".$name."'");

	$term_id = $data[0]->term_id;
	$wpdb->get_results( "INSERT INTO `".$wpdb->prefix."term_taxonomy`(`term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES ('".$term_id."','pa_weight','','0','0')");
	//
}
add_action('wp_ajax_add_weight_attr', 'add_weight_attr' ); 
add_action('wp_ajax_nopriv_add_weight_attr', 'add_weight_attr' ); 



/* ==================== social share ============================== */



?>

