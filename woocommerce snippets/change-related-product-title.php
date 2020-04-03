<?php
/**
 * Change Related product title
 */
if( ! function_exists( 'product_related_product_heading' ) ) {
	/**
	 * Change Related Products heading on single product page
	 *
	 * @param $text
	 * @return $text
	 */
	function product_related_product_heading($text) {
		$text = __( 'Related Models', 'text-domain' );
		return $text;
	}
}
add_filter( 'woocommerce_product_related_products_heading', 'product_related_product_heading' );