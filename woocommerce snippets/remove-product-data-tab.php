<?php
// Remove the default product description tab
if ( ! function_exists( 'remove_product_description_tab' ) ) {
	/**
	 * This function removes the default product description tab from single
	 * product page
	 * 
	 */
	function remove_product_description_tab($tabs) {
		unset( $tabs['description'] );
		return $tabs;
	}
}
add_filter('woocommerce_product_tabs', 'remove_product_description_tab', 10);