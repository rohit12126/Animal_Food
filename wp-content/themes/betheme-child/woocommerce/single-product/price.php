<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>

<div class="product-price">
    <?php echo $product->get_price_html(); ?>
</div>

<?php
	
	if ( $product->is_in_stock()) 
		$stock_show = "In Stock";
	else
		$stock_show = "Out Stock";

?>

<div class="in-stock">
    <span><i class="ion-android-checkbox-outline"></i> <?php echo $stock_show; ?></span>
</div>

<div class="sku">
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>
</div>