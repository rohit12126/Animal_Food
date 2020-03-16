<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes ----------
$classes = array();
$classes[] = 'isotope-item';

// Product type - Buttons ----------
if( ! $product->is_in_stock() || mfn_opts_get( 'shop-catalogue' ) || in_array( $product->get_type(), array( 'external', 'grouped', 'variable' ) ) ){
	
	$add_to_cart = false;
	$image_frame = false;
	
} else {
	
	/* developers: $product->get_id() @since WC 2.5 */
	
	if( $product->supports( 'ajax_add_to_cart' ) ){
		$add_to_cart = '<a title="Add To Cart" href="?add-to-cart='.get_the_ID().'" data-quantity="1" data-product_id="'.get_the_ID().'" class="add_to_cart_button ajax_add_to_cart product_type_simple"><i class="ti-shopping-cart"></i></a>';
	} else {
		$add_to_cart = '<a title="Add To Cart" href="?add-to-cart='.get_the_ID().'" data-quantity="1" data-product_id="'.get_the_ID().'" class="add_to_cart_button ajax_add_to_cart product_type_simple"><i class="ti-shopping-cart"></i></a>';
	}

	$image_frame = 'double';
}


?>



<div class="product-width col-lg-6 col-xl-4 col-md-6 col-sm-6">
    <div class="product-wrapper mb-10">
        <div class="product-img">
            <a href="<?php echo apply_filters( 'the_permalink', get_permalink()); ?>">
               <?php

					if( has_post_thumbnail() ){
						the_post_thumbnail( 'shop_catalog', array( 'class' => 'visible_photo scale-with-grid' ) );
					} elseif ( wc_placeholder_img_src() ) {
						echo wc_placeholder_img( 'shop_catalog' );
					}
               ?>
            </a>
            <div class="product-action">
                <a title="Quick View" data-toggle="" data-target="" href="<?php echo apply_filters( 'the_permalink', get_permalink()); ?>">
                    <i class="ti-plus"></i>
                </a>
                <?php echo $add_to_cart; ?>
            </div>
            <div class="product-action-wishlist">
                <?php echo do_shortcode("[yith_wcwl_add_to_wishlist]"); ?>
            </div>
        </div>
        <div class="product-content">
            <h4><a href="<?php echo apply_filters( 'the_permalink', get_permalink()); ?>"><?php the_title(); ?></a></h4>
            <div class="product-price">
                <?php echo $product->get_price_html(); ?>
            </div>
        </div>
        <div class="product-list-content">
            <h4><a href="<?php echo apply_filters( 'the_permalink', get_permalink()); ?>"><?php the_title(); ?></a></h4>
            <div class="product-price">
                <?php echo $product->get_price_html(); ?>
            </div>
            <p><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?></p>
            <div class="product-list-action">
                <div class="product-list-action-left">
                    <?php echo $add_to_cart; ?>
                </div>
                <div class="product-list-action-right">
                    <?php echo do_shortcode("[yith_wcwl_add_to_wishlist]"); ?>
                    <a title="Quick View" data-toggle="modal" data-target="" href="<?php echo apply_filters( 'the_permalink', get_permalink()); ?>"><i class="ti-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>



