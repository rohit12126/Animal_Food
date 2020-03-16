<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );
	
	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
	
	
	// prev & next post -------------------
	$single_post_nav = array(
		'hide-header'	=> false,
		'hide-sticky'	=> false,
	);
	
	$opts_single_post_nav = mfn_opts_get( 'prev-next-nav' );
	if( is_array( $opts_single_post_nav ) ){
	
		if( isset( $opts_single_post_nav['hide-header'] ) ){
			$single_post_nav['hide-header'] = true;
		}
		if( isset( $opts_single_post_nav['hide-sticky'] ) ){
			$single_post_nav['hide-sticky'] = true;
		}
	
	}
	
	$post_prev = get_adjacent_post( false, '', true );
	$post_next = get_adjacent_post( false, '', false );
	
	// WC < 2.7 backward compatibility
	if( version_compare( WC_VERSION, '2.7', '<' ) ){
		$shop_page_id = woocommerce_get_page_id( 'shop' );
	} else {
		$shop_page_id = wc_get_page_id( 'shop' );
	}

	
	// post classes -----------------------
	$classes = array();
	
	if( mfn_opts_get( 'share' ) == 'hide-mobile' ){
		$classes[] = 'no-share-mobile';
	} elseif( ! mfn_opts_get( 'share' ) ) {
		$classes[] = 'no-share';
	}
	
	$single_product_style = mfn_opts_get( 'shop-product-style' );
	$classes[] = $single_product_style;
	 
	
	// translate
	$translate['all'] = mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');
	
	
	// WC < 2.7 backward compatibility
	if( version_compare( WC_VERSION, '2.7', '<' ) ){		
		$product_schema = 'itemscope itemtype="'. woocommerce_get_product_schema() .'"';
	} else {
		$product_schema = '';
	}
?>

<div class="shop-area pt-95 pb-100" id="product-<?php the_ID(); ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="product-details-img">
					<?php
						/**
						 * woocommerce_before_single_product_summary hook.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );	
					?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="product-details-content">
					<?php
						/**
						 * woocommerce_single_product_summary hook.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="description-review-area pb-100">
	<div class="container">
		<div class="description-review-wrapper gray-bg pt-40">
			<div class="description-review-topbar nav text-center">
			    <a class="active" data-toggle="tab" href="#des-details1">DESCRIPTION</a>
			    <a data-toggle="tab" href="#des-details2">MORE INFORMATION</a>
			    <a data-toggle="tab" href="#des-details3">REVIEWS</a>
			</div>
			<div class="tab-content description-review-bottom">
				<div id="des-details1" class="tab-pane active">
					<div class="product-description-wrapper">
						<?php the_content(); ?>
					</div>
				</div>
				<div id="des-details2" class="tab-pane ">
					<div class="product-anotherinfo-wrapper">
						<?php
							global $product;
							do_action( 'woocommerce_product_additional_information', $product );
						?>
					</div>
				</div>
				<div id="des-details3" class="tab-pane ">
					
					<?php woocommerce_get_template( 'single-product-reviews.php' ); ?>


				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="related-product-area pt-95 pb-80 gray-bg">
    <div class="container">
        <div class="section-title text-center mb-55">
            <h4>Most Populer</h4>
            <h2>Related Products</h2>
        </div>
        <div class="related-product-active owl-carousel">
        	<?php  

				$term_list = wp_get_post_terms($product->id,'product_cat',array('fields'=>'ids'));
				$cat_id = (int)$term_list[0];

				//echo $cat_id;

				$args = array(
				'terms'     =>  $cat_id,
				'taxonomy' => 'product_cat',
				'post_type' => 'product',
				'posts_per_page' => $per_page,
				'orderby' =>'date',
				'order' => 'DESC' );

				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					global $product;
					if (has_post_thumbnail( $loop->post->ID ))
					$image = get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
					else
					$image = '<img src="'.woocommerce_placeholder_img_src().'" alt="My Image Placeholder" />';
					if( $product->is_type( 'simple' ) )
						$actions = '<a title="Quick View" data-toggle="" data-target="" href="'.get_permalink( $product->ID ).'"><i class="ti-plus"></i></a>
					<a title="Add To Cart" href="?add-to-cart='.get_the_ID().'" data-quantity="1" data-product_id="'.get_the_ID().'" class="add_to_cart_button ajax_add_to_cart product_type_simple"><i class="ti-shopping-cart"></i></a>';
					else
						$actions = '<a title="Quick View" data-toggle="" data-target="" href="'.get_permalink( $product->ID ).'"><i class="ti-plus"></i></a>';
        	?>



            <div class="product-wrapper">
                <div class="product-img">
                    <a href="<?php echo get_permalink( $product->ID ); ?>">
                        <?php echo $image; ?>
                    </a>
                    <div class="product-action">
                        <?php echo $actions; ?>
                    </div>
                    <div class="product-action-wishlist">
                        <?php echo do_shortcode("[yith_wcwl_add_to_wishlist]"); ?>
                    </div>
                </div>
                <div class="product-content">
                    <h4><a href="<?php echo get_permalink( $product->ID ); ?>"><?php echo get_the_title( $product->ID ); ?></a></h4>
                    <div class="product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                </div>
            </div>
			<?php
			endwhile;
			wp_reset_query(); 

			?>
        </div>
    </div>
</div>